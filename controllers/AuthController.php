<?php

class AuthController
{
    protected $connect;

    function __construct()
    {
        $this->connect = dbConnect();
    }

    public function login($request)
    {
        $email = $request['email'];
        $password = $request['password'];
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $password = md5($password);
        $sql = "SELECT * FROM user WHERE email = '$email' OR username = '$email' AND password = '$password'";
        try {
            $result = mysqli_query($this->connect, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if ($count ) {
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['nama_user'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['alamat'] = $row['alamat'];
                $_SESSION['no_telp'] = $row['no_telp'];

                // get kota
                require_once 'KotaController.php';
                $kotaController = new KotaController();
                $kota = $kotaController->ambil_kota_by_id($row['id_kota']);
                $_SESSION['nama_kota'] = $kota['nama_kota'];

                header("location: index.php");
            } else {
                $error = "Your Login Email or Password is invalid";
                $_SESSION['error_login'] = $error;
                //header("location: login.php");
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
            // header("location: index.php");
        }
    }

    public function logout()
    {
        // revoke session
        session_start();
        session_destroy();
        header("location: login.php");
    }

    public function register($request)
    {
        // create register function with html_escape_characters php native
        $name = $request['name'];
        $kota = $request['kota'];
        $username = $request['username'];
        $no_telp = $request['no_telp'];
        $email = $request['email'];
        $alamat = $request['alamat'];
        $password = $request['password'];
        $password_confirmation = $request['password_confirmation'];
        $name = htmlspecialchars($name);
        $kota = htmlspecialchars($kota);
        $no_telp = htmlspecialchars($no_telp);
        $email = htmlspecialchars($email);
        $alamat = htmlspecialchars($alamat);
        $password = htmlspecialchars($password);
        $password_confirmation = htmlspecialchars($password_confirmation);
        // check password is match with confirm password
        if ($password != $password_confirmation) {
            $error = "Password is not match with confirm password";
            $_SESSION['error_register'] = $error;
            return header("location: register.php");
        }

        // validasi no telpon

        $password = md5($password);
        $sql = "INSERT INTO user (username, nama_user, email, password, role, no_telp, id_kota, alamat,code)
         VALUES ('$username','$name', '$email', '$password', 'user', '$no_telp', '$kota', '$alamat','')";
        try {
            $result = mysqli_query($this->connect, $sql);
            if ($result) {
                // set session
                $_SESSION['id_user'] = mysqli_insert_id($this->connect);
                $_SESSION['username'] = $username;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = 'user';
                $_SESSION['no_telp'] = $no_telp;
                $_SESSION['alamat'] = $alamat;

                // get kota 
                $kotaController = new KotaController();
                $kota = $kotaController->ambil_kota_by_id($kota);
                $_SESSION['nama_kota'] = $kota['nama_kota'];
                $_SESSION['id_kota'] = $kota['id_kota'];
                header("location: index.php");
            } else {
                $error = "Your Login Email or Password is invalid";
                $_SESSION['error_register'] = $error.$result;
               

                header("location: register.php");
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function checkemail($request){
        //if user click continue button in forgot password form
        $email = $request['email'];
        $check_email = "SELECT * FROM user WHERE email='$email'";
        $run_sql = mysqli_query($this->connect, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE user SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($this->connect, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: steven@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a password reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }
    public function changepassword($request){
        //if user click change password button
        if(isset($_POST['change-password'])){
            $_SESSION['info'] = "";
            $password = $request['password'];
            $cpassword = $request['cpassword'];
            if($password !== $cpassword){
                $errors['password'] = "Confirm password not matched!";
            }else{
                $code = 0;
                $email = $_SESSION['email']; //getting this email using session
                $encpass = password_hash($password, PASSWORD_BCRYPT);
                $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
                $run_query = mysqli_query($this->connect, $update_pass);
                if($run_query){
                    $info = "Your password changed. Now you can login with your new password.";
                    $_SESSION['info'] = $info;
                    header('Location: password-changed.php');
                }else{
                    $errors['db-error'] = "Failed to change your password!";
                }
            }
        }
    }
    public function checkotp($request){
        if(isset($_POST['check-reset-otp'])){
            $_SESSION['info'] = "";
            $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
            $check_code = "SELECT * FROM user WHERE code = $otp_code";
            $code_res = mysqli_query($this->connect, $check_code);
            if(mysqli_num_rows($code_res) > 0){
                $fetch_data = mysqli_fetch_assoc($code_res);
                $email = $fetch_data['email'];
                $_SESSION['email'] = $email;
                $info = "Please create a new password that you don't use on any other site.";
                $_SESSION['info'] = $info;
                header('location: new-password.php');
                exit();
            }else{
                $errors['otp-error'] = "You've entered incorrect code!";
            }
        }
    }
}
