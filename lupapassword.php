<?php include("inc_header.php")?>
<h3>Lupa Password</h3>
<?php
if(isset($_SESSION['user_email']) !=''){
    header("location:index.php");
    exit();
}

$err    = "";
$sukses = "";
$email  = "";

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    if($email == ''){
        $err = "silahkan masukkan email";
    }else{
        $sql1   = "select * from members where email = '$email'";
        $q1     = mysqli_query($koneksi,$sql1);
        $n1     = mysqli_num_rows($q1);

        if($n1 < 1){
            $err = "Email: <b>$email</b> tidak ditemukan";
        }
    }

    if(empety($err)){
        $token_ganti_password  = md5(rand(0,1000));
        $judul_email           = "ganti password";
        $isi_email             = "Seseorang meminta untuk melakukan perubahan password. Silahkan klik link di bawah ini:<br/>";
        $isi_email             .= url_dasar(). "/ganti_password.php?email&token=$token_ganti_password";
        kirim_email($email,$email,$udul_email,$isi_email);

        $sql1   ="update members set token_ganti_password";
        mysqli_query($koneksi,$sql1);
        $sukes  ="link ganti password sudah dikirim ke email anda.";
    }
}
?>
<?php if($err){ echo "<div class='error'>$err</div>";}?>
<?php if($sukses){ echo "<div class='sukes'>$sukses</div>";}?>
<from action="" method="POST">
    <table>
        <tr>
            <td class="label">email</td>
            <td><input type="text" name="email" class="input" value="<?php echo $email?>"/></t d>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="submit" value="konfirmasi" class="tbl-biru"/>
            </td>
        </tr>
    </table>
</from>
<?php include ("inc_footer.php");?> 