<?php
include_once 'config/connect.php';
if(isset($_SESSION['username']) !=''){
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
        $sql   = "SELECT * FROM user WHERE email = '$email'";
        $q1     = mysqli_query($sql,MYSQLI_ASSOC);
        $n1     = mysqli_num_rows($q1);

        if($n1 < 1){
            $err = "Email: <b>$email</b> tidak ditemukan";
        }
    }

    if(empty($err)){
        $token_ganti_password  = md5(rand(0,1000));
        $judul_email           = "ganti password";
        $isi_email             = "Seseorang meminta untuk melakukan perubahan password. Silahkan klik link di bawah ini:<br/>";
        $isi_email             .= url_dasar(). "/ganti_password.php?email&token=$token_ganti_password";
        kirim_email($email,$email,$judul_email,$isi_email);

        $sql1   ="UPDATE user SET token_ganti_password";
        mysqli_query($koneksi,$sql1);
        $sukes  ="link ganti password sudah dikirim ke email anda.";
    }
}
?>
<?php if($err){ echo "<div class='error'>$err</div>";}?>
<?php if($sukses){ echo "<div class='sukes'>$sukses</div>";}?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="./dist/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="./dist/fontawesome/css/brands.min.css">
    <link rel="stylesheet" href="./dist/fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="./dist/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles.css">

    <!-- Scripts -->
    <script src="./dist/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<header id="header">
        <div class="container-fluid mx-auto">
            <div class="topbar row align-items-center md:justfy-content-center">
                <div class="col-lg-4 ms-auto">
                    <div class="logo">MAYASARI</div>
                </div>
                <div class="col-lg-8  header-info-list">
                    <div class="header-info-item">
                        <i class="fa fa-phone"></i>
                        <span>1-888-546-789</span>
                    </div>
                    <div class="header-info-item">
                        <i class="fa fa-map-pin"></i>
                        <span> Jl. Mastrip, Krajan Timur, Sumbersari, Jember</span>
                    </div>
                    <div class="header-info-item">
                        <i class="fa fa-clock"></i>
                        <span> 10:00 - 18:00, Senin - Jumat</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
<main id="lupa_password">
    <div class="card auth-card">
        <div class="card-body">
            <h3 class="card-title">Forgot Password</h3>
   
        <form action="" class="form-auth" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Masukkan Email anda" value="<?php echo $email?>">
        </div>
    <button type="submit" name="submit" class="btn btn-primary w-100">Konfirmasi</button>
</form>
</div>
</main>
<footer id="footer">
        <div class="container">
            <div class="row">
                <h3 class="footer-logo">HRVST</h3>
                <p class="footer-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem odio quis
                    debitis ea, sunt
                    tempora.</p>
                <div class="footer-links">
                    <a class="footer-link-item" href="#">Metode Pembayaran</a>
                    <a class="footer-link-item" href="#">Bantuan</a>
                    <a class="footer-link-item" href="#">Customer</a>
                    <a class="footer-link-item" href="#">Syarat dan Ketentuan</a>
                </div>
                <div class="footer-social">
                    <a class="footer-link-social" href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a class="footer-link-social" href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a class="footer-link-social" href="#"><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
