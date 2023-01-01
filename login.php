<?php
session_start();
include 'config/connect.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("location: index.php");

    }
}
if (isset($_POST['submit_login'])) {
    require_once 'controllers/AuthController.php';
    $auth = new AuthController();
    $auth->login($_REQUEST);
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
                    <div class="logo">MAYASARI</div>
                </div>
                <div class="col-lg-8  header-info-list">
                    <div class="header-info-item">
                        <i class="fa fa-phone"></i>
                        <span>1-888-546-789</span>
                    </div>
                    <div class="header-info-item">
                        <i class="fa fa-map-pin"></i>
                        <span> Jl. Tamansari, Wuluhan, Jember</span>
                    </div>
                    <div class="header-info-item">
                        <i class="fa fa-clock"></i>
                        <span> 07:00 - 17:00, Senin - Sabtu</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main id="login">
        <div class="card auth-card">
            <div class="card-body">
                <h3 class="card-title">Login</h3>
                <!-- check if there an error -->
                <?php if (isset($_SESSION['error_login'])) { ?>
                    <div class="text-danger fw-bold mb-3">
                        <?= $_SESSION['error_login']; ?>
                    </div>
                <?php
                    unset($_SESSION['error_login']);
                } ?>

                <form action="" class="form-auth" method="POST">
                    <div class="form-group ">
                         <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button type="submit" name="submit_login" class="btn btn-primary w-100">Login</button>
                </form>
                <a href="lupapassword.php" class="mt-2"><span>Lupa Password</span></a>
                <hr>
                <a class="text-center" href="register.php"><span>Belum punya akun? <span class="text-dark">buat
                            sekarang</span></span></a>
                <a class="text-center" href="#"><span>butuh bantuan?</span></a>
            </div>
    </main>
    <footer id="footer">
        <div class="container">
            <div class="row">
                <h3 class="footer-logo">MAYASARI</h3>
                <p class="footer-desc"></p>
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