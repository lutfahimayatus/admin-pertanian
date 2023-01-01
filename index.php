<?php
session_start();
include 'config/connect.php';
require_once 'config/utils.php';
require_once 'controllers/ProdukController.php';
require_once 'controllers/CartController.php';

$produk = new ProdukController();
$data = $produk->ambil_produk();


if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = [];
}

$cart2 = new CartController();
$total_cart = $cart2->get_number_cart($cart);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | E-Commerce</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="./dist/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="./dist/fontawesome/css/brands.css">
    <link rel="stylesheet" href="./dist/fontawesome/css/solid.css">
    <link rel="stylesheet" href="./dist/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./styles.css">

    <!-- Scripts -->
    <script src="./dist/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header id="header">
        <div class="container-fluid mx-auto">
            <div class="topbar row align-items-center justify-content-between">
                <div class="col-lg-4 col-4 ">
                    <div class="logo">MAYASARI</div>
                </div>
                <div class="col-lg-8  header-info-list">
                    <div class="header-info-item">
                        <i class="fa fa-phone"></i>
                        <span>1-888-546-789</span>
                    </div>
                    <div class="header-info-item">
                        <i class="fa fa-map-pin"></i>
                        <span>Jl. Tamansari, Wuluhan, Jember</span>
                    </div>
                    <div class="header-info-item">
                        <i class="fa fa-clock"></i>
                        <span> 07:00 - 17:00, Senin - Sabtu</span>
                    </div>
                </div>
                <div class="col-lg-4 col-4 text-end lg-hidden">
                    <span class="avatar-dropdown">
                        <i class="fa fa-user"></i>
                    </span>
                </div>
            </div>
        </div>
    </header>
    <main id="home">
        <section class="hero">
            <div class="container-fluid">
                <div class="hero-topbar row">
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class=" search-form flex-0">
                            <input type="text" name="search" id="search" class="search-input form-control" placeholder="Temukan pencarian terbaik hanya di MAYASARI">
                            <span class="text-dark">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>

                        <?php
                        if (!isset($_SESSION['id_user'])) {
                        ?>
                            <div>
                                <a href="register.php">
                                    <button class="btn btn-primary sm-hidden">Register</button>
                                </a>
                                <a href="login.php">
                                    <button class="btn btn-primary sm-hidden">Login</button>
                                </a>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="d-flex">
                                <a href="keranjang.php">
                                    <span class="cart-icon text-dark sm-hidden">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="badge"><?= $total_cart; ?></span>
                                    </span>
                                </a>
                                <div class="dropdown ms-4">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?= $_SESSION['name']; ?>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                        <li><a class="dropdown-item" href="order-history.php">Order History</a></li>
                                        <li>
                                            <a class="dropdown-item" href="keranjang.php">
                                                Keranjang
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="logout.php">
                                                Logout
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="row hero-content">
                    <div class="col">
                        <h1>Tentukan Kemudahan Dalam Pertanian Anda</h1>
                        <p>In publishing and graphic design. In publishing and graphic design, Lorem ipsum is a
                            placeholder text commonly used to demonstrate the visual form of a document or a
                            typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder
                            before final copy is available.</p>
                        <div class="d-flex justify-content-center gap-4">
                            <button class="btn btn-primary"><a href="register.php">Join Now</a></button>
                            <button class="btn btn-outline-light"><a href="#testimonials">Testimonial</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sponsored">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <h2 class="text-title-h2">Dipercaya oleh beberapa instansi</h2>
                    </div>
                </div>
                <div class="row justify-content-between align-items-center text-center">
                    <div class=" col-3">
                        <img class="sponsored-img" src="./assets/images/logo-jember-bw.png" alt="logo jember">
                    </div>
                    <div class="col-3">
                        <img class="sponsored-img" src="./assets/images/logo-kementerian-lingkungan-hidup-dan-kehutanan.png" alt="logo kementerian lingkungan hidup dan kehutanan jember">
                    </div>
                    <div class="col-3">
                        <img class="sponsored-img" src="./assets/images/logo-kementerian-pertanian-bw.png" alt="logo kementerian pertanian jember">
                    </div>
                </div>
            </div>
        </section>
        <section class="why-choose-us">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class=" col-lg-6 md:col-lg-12">
                        <div class="img-wrapper">
                            <img src="assets/images/photo-section.png" class="section-photo" alt="kenapa-memilih-kami">
                        </div>
                    </div>
                    <div class="col-lg-6 md:col-lg-12">
                        <h2>Mengapa harus memilih produk kami ?</h2>
                        <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to
                            demonstrate</p>
                        <ul class="why-choose-us-list">
                            <li><i class="fa fa-check text-primary me-4 mb-3"></i><span class="fw-semibold">In
                                    Publishing and graphic
                                    design</span>
                            </li>
                            <li>
                                <i class="fa fa-check text-primary me-4 mb-3"></i><span class="fw-semibold">In
                                    Publishing and graphic
                                    design</span>
                            </li>
                            <li>
                                <i class="fa fa-check text-primary me-4 mb-3"></i><span class="fw-semibold">In
                                    Publishing and graphic
                                    design</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="product-home">
            <?php
            include 'components/produk-unggulan.php';
            ?>
        </section>
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