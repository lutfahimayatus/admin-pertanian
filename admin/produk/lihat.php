<?php
ob_start();
$title = "Login";
$css = [
    "node_modules/bootstrap-daterangepicker/daterangepicker.css",
    "node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css",
    "node_modules/select2/dist/css/select2.min.css",
    "node_modules/selectric/public/selectric.css",
    "node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css",
    "node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",
    "node_modules/dropzone/dist/min/dropzone.min.css",
];
// admin\layouts\header.php
include('../layouts/header.php');
if (isset($_GET['id'])) {
    require_once '../controllers/ProdukController.php';
    $produkController = new ProdukController();
    $data = $produkController->lihat_produk($_GET['id']);
}
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Advanced Forms</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Forms</a></div>
                <div class="breadcrumb-item">Produk</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Lihat Detail Produk</h2>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Lihat Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Nama Produk</label>
                                        <input disabled value="<?= $data['id_produk'] ?? ''; ?>" type="text" name="nama" class="form-control">

                                    </div>
                                    <div class="form-group">
                                        <label>Harga Prdouk</label>
                                        <input disabled value="<?= $data['harga'] ?? ''; ?>" type="text" name="harga" class="form-control">

                                    </div>
                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input disabled value="<?= $data['stok'] ?? ''; ?>" type="text" name="stok" class="form-control">

                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi Produk</label>
                                        <textarea disabled name="deskripsi" class="form-control text-start" rows="10" style="height: 100px;">
                                            <?= $data['deskripsi_produk'] ?? ''; ?>
                                            </textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 order-1">
                                    <label for="">Gambar Produk</label>
                                    <div class="row">
                                        <?php
                                        $images = explode(",", $data['gambar'] ?? null);
                                        if ($images) {
                                            foreach ($images as $image) { ?>
                                                <div class="col-6">
                                                    <img src='../assets/images/produk/<?= $image; ?>' width='400px' height='400px' class='img-thumbnail'>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <a href="index.php" class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<!-- End Main Content -->

<?php
$js = [
    "node_modules/cleave.js/dist/cleave.min.js",
    "node_modules/cleave.js/dist/addons/cleave-phone.us.js",
    "node_modules/jquery-pwstrength/jquery.pwstrength.min.js",
    "node_modules/bootstrap-daterangepicker/daterangepicker.js",
    "node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js",
    "node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js",
    "node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js",
    "node_modules/select2/dist/js/select2.full.min.js",
    "node_modules/selectric/public/jquery.selectric.min.js",
    "node_modules/dropzone/dist/min/dropzone.min.js"

];
$js_page = [
    "page/form.js",
];
include('../layouts/footer.php');
?>
<script>
    document.title = "Lihat Detail Produk";
</script>