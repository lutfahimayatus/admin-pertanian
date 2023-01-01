<?php
+include 'config/connect.php';
session_start();
require_once 'config/utils.php';
require_once 'controllers/ProdukController.php';

$produk = new ProdukController();
$data = $produk->ambil_produk();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Produk | E-Commerce</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="./dist/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="./dist/fontawesome/css/brands.min.css">
    <link rel="stylesheet" href="./dist/fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="./dist/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles.css">

    <!-- Scripts -->
    <script src="./dist/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include 'components/header.php'; ?>
    <main id="home">
        <section class="all-product">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="product-title">Daftar Produk</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <ul class="d-flex list-category">
                            <li>
                                <button class="btn btn-primary">Semua</button>
                            </li>
                            <li>
                                <button class="btn btn-outline-secondary">Pestisida</button>
                            </li>
                            <li>
                                <button class="btn btn-outline-secondary">Organik</button>
                            </li>
                            <li>
                                <button class="btn btn-outline-secondary">Pupuk</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <?php
                    foreach ($data as $row) {
                        $gambar = explode(',', $row['gambar'])
                    ?>
                        <div class="col-lg-4 col-12">
                            <div class="card product-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="product-price">Rp. <?= rupiah($row['harga']); ?></div>
                                    <div class="product-sale">10 Terjual</div>
                                </div>
                                <div class="product-image">
                                    <img src="admin/assets/images/produk/<?= $gambar[0]; ?>" alt="product 1">
                                </div>
                                <div class="product-rating text-end">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <hr>
                                <h4 class="product-name"><?= $row['nama_produk']; ?></h4>
                                <button class="btn btn-primary"><a href="cart.php?id_produk=<?= $row['id_produk']; ?>&quantity=1">Tambah ke keranjang</a></button>
                                <button class="btn btn-primary mt-2"><a href="detail-produk.php?id_produk=<?= $row['id_produk']; ?>">Detail Produk</a></button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
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