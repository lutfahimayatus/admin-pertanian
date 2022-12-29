<?php
ob_start();
session_start();
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


include('../layouts/header.php');
if (isset($_POST['submit_data'])) {
    require_once '../controllers/ProdukController.php';
    $produkController = new ProdukController();
    $produkController->tambah_produk($_REQUEST);
}
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Forms</a></div>
                <div class="breadcrumb-item">Produk</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Tambah Produk</h2>
            <p class="section-lead">Silahkan tambahkan produk</p>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Data</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Nama Produk</label>
                                            <input type="text" name="nama" class="form-control">
                                            <?php if (isset($_SESSION['input_error']['nama'])) { ?>
                                                <div class="text-danger text-sm" role="alert">
                                                <?php echo $_SESSION['input_error']['nama'] ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Prdouk</label>
                                            <input type="text" name="harga" class="form-control">
                                            <?php if (isset($_SESSION['input_error']['harga'])) { ?>
                                                <div class="text-danger text-sm" role="alert">
                                                    <?php echo $_SESSION['input_error']['harga'] ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Stok</label>
                                            <input type="text" name="stok" class="form-control">
                                            <?php if (isset($_SESSION['input_error']['stok'])) { ?>
                                                <div class="text-danger text-sm" role="alert">
                                                    <?php echo $_SESSION['input_error']['stok'] ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi Produk</label>
                                            <textarea name="deskripsi" class="form-control" rows="10" style="height: 100px;">
                                        </textarea>
                                            <?php if (isset($_SESSION['input_error']['deskripsi'])) { ?>
                                                <div class="text-danger text-sm" role="alert">
                                                    <?php echo $_SESSION['input_error']['deskripsi'] ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 order-1">
                                        <label for="">Gambar Produk</label>
                                        <input type="file" id="gambar" name="gambar[]" multiple class="form-control">
                                        <div id="preview" class="row"></div>
                                        <?php if (isset($_SESSION['input_error']['gambar'])) { ?>
                                            <div class="text-danger text-sm" role="alert">
                                                <?php echo $_SESSION['input_error']['gambar'] ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <button type="submit" name="submit_data" class="btn btn-primary w-100">Submit</button>
                                    </div>
                                </div>
                            </form>
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
    document.title = "Tambah Produk";
</script>