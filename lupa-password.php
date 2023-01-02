<?php
session_start();
include 'config/connect.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("location: index.php");
    }
}
// if submit forget password
if ($_POST['submit_forget_password']) {
    require_once 'controllers/AuthController.php';
    $auth = new AuthController();
    $auth->forget_password($_REQUEST);
}
// check if login or not if no show alert and redirect to login.php
if (!isset($_SESSION['role'])) {
    return header('location: login.php');
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | E-Commerce</title>
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
                    <div class="logo">HRVST</div>
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
                        <span> 10:00 - 18:00, Senin - Jum'at</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main id="login">
        <div class="card auth-card">
            <div class="card-body">
                <h3 class="card-title">Lupa Password</h3>
                <p>Untuk Email: <?= $_SESSION['name']; ?></p>
                <br>
                <!-- check if there an error -->
                <?php if (isset($_SESSION['error_forget_password'])) { ?>
                    <div class="text-danger fw-bold mb-3">
                        <?= $_SESSION['error_forget_password']; ?>
                    </div>
                <?php
                    unset($_SESSION['error_forget_password']);
                } ?>

                <form action="" class="form-auth" method="POST">

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Konfirmasi Password</label>
                        <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control" placeholder="Konfirmasi Password" required>
                    </div>
                    <button type="submit" name="submit_forget_password" class="btn btn-primary w-100">Submit</button>

                </form>
                <hr>
                <a class="text-center" href="index.php"><span>Kembali ke halaman utama</span></a>
                <a class="text-center" href="#"><span>butuh bantuan?</span></a>
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