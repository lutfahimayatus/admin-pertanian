<?php
+include 'config/connect.php';
session_start();
include_once 'config/connect.php';
require_once 'config/utils.php';

if (isset($_GET['id_produk'])) {
    require_once 'controllers/ProdukController.php';
    $produk = new ProdukController();
    $data = $produk->random_list_produk();
    $item = $produk->lihat_produk($_GET['id_produk']);
} else {
    header('location: 404.php');
}
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
    <!-- <link rel="stylesheet" href="./dikst/fontawesome/css/brands.min.css"> -->
    <link rel="stylesheet" href="./dist/fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="./dist/bootstrap/css/bootstrap.min.css">

    <!-- Scripts -->
    <script src="./dist/bootstrap/js/bootstrap.bundle.js"></script>

    <!-- Slick Js -->
    <link rel="stylesheet" type="text/css" href="./dist/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="./dist/slick/slick-theme.css" />
    <link rel="stylesheet" href="./styles.css">
</head>

<body>
    <?php include 'components/header.php'; ?>
    
    <main id="home">
        <section class="detail-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card ">
                            <div class="mx-auto detail-product-image">
                                <?php
                                $data_gambar = explode(',', $item['gambar']);
                                foreach ($data_gambar as $row) {
                                    $i = 0;
                                ?>
                                    <div>
                                        <img src="admin/assets/images/produk/<?= $row; ?>" alt=" <?= $item['nama_produk']; ?>">
                                    </div>
                                <?php
                                    $i++;
                                } ?>
                            </div>
                        </div>
                        <div class="slider-nav">
                            <?php
                            foreach ($data_gambar as $row) {
                                $i = 0;
                            ?>
                                <div class="detail-product-image-indicator">
                                    <img src="admin/assets/images/produk/<?= $row; ?>" alt=" <?= $item['nama_produk']; ?>">
                                </div>
                            <?php
                                $i++;
                            } ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body row detail-product-card">
                                <h3 class="detail-product-title"><?= $item['nama_produk']; ?></h3>
                                <hr>
                                <div class="detail-product-rating mb-2 d-flex">
                                    <div class="product-rating me-3">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div><span>reviews</span>
                                </div>
                                <h3 class="detail-product-price">Rp. <?= rupiah($item['harga']); ?></h3>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mb-4 qty-detail-product">
                                    <span>Kuantitas</span>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-primary" id="subQty">-</button>
                                        <input type="text" class="form-control text-center border" id="qty" value="1">
                                        <button class="btn btn-primary" id="addQty">+</button>
                                    </div>
                                    <span>tersisa <?= $item['stok']; ?> item</span>
                                </div>
                                <button class="btn btn-primary mb-3"onclick="addToCart(<?= $item['id_produk']; ?>)">Beli Sekarang</button>
                                <button class="btn btn-outline-secondary mb-3" onclick="addToCart(<?= $item['id_produk']; ?>)">Tambah ke Keranjang</button>
                                <hr>
                                <div class="detail-product-description">
                                    <h4>Deskripsi Produk</h4>
                                    <p><?= $item['deskripsi_produk']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="product-home">
            <?php include 'components/produk-unggulan.php' ?>
        </section>
    </main>
    <footer id="footer">
        <div class="container">
            <div class="row">
                <h3 class="footer-logo">MAYASARI</h3>
                <p class="footer-desc">a.</p>
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

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="./dist/slick/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.detail-product-image').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                asNavFor: '.slider-nav'
            });
            $('.slider-nav').slick({
                slidesToShow: 4,
                asNavFor: '.detail-product-image',
                focusOnSelect: true
            });



        });

        $('#addQty').click(function() {
            var qty = parseInt($('#qty').val());
            $('#qty').val(qty + 1);
        });
        $('#subQty').click(function() {
            var qty = parseInt($('#qty').val());
            if (qty > 1) {
                $('#qty').val(qty - 1);
            }
        });

        function addToCart(id_produk) {
            $.ajax({
                url: 'cart.php',
                type: 'POST',
                data: {
                    id_produk: id_produk,
                    quantity: $('#qty').val()
                },
                success: function(data) {
                    location.reload();
                }
            })
        }

        function addToBuy(id_produk) {
            $.ajax({
                url: 'buy.php',
                type: 'POST',
                data: {
                    id_produk: id_produk,
                    quantity: $('#qty').val()
                },
                success: function(data) {
                    // location to beli-sekarang.php
                    location.href = 'beli-sekarang.php';
                }
            })
        }
    </script>
</body>


</html>