<?php
ob_start();
session_start();
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
    require_once '../controllers/KotaController.php';
    $kotaController = new KotaController();
    $kotaController->tambah_Kota($_REQUEST);
}
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kota</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Forms</a></div>
                <div class="breadcrumb-item">Kota</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Tambah Kota</h2>
            <p class="section-lead">Silahkan tambahkan Kota</p>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Data</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Nama Kota</label>
                                            <input type="text" name="nama" class="form-control">
                                            <?php if (isset($_SESSION['input_error']['nama_kota'])) { ?>
                                                <div class="text-danger text-sm" role="alert">
                                                    <?php echo $_SESSION['input_error']['nama_kota'] ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Ongkos Kirim</label>
                                            <input type="text" name="ongkos_kirim" class="form-control">
                                            <?php if (isset($_SESSION['input_error']['ongkos_kirim'])) { ?>
                                                <div class="text-danger text-sm" role="alert">
                                                    <?php echo $_SESSION['input_error']['ongkos_kirim'] ?>
                                                </div>
                                            <?php } ?>
                                        </div>
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
    document.title = "Tambah Kota";
</script>