<?php
ob_start();
session_start();
$title = "Login";
$css = [
    "node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css",
    "node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css"
];


include('../layouts/header.php');
require_once '../controllers/KotaController.php';
$kotaController = new KotaController();
$data = $kotaController->ambil_kota();
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>DataTables</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Modules</a></div>
                <div class="breadcrumb-item">DataTables</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">DataTables</h2>
            <p class="section-lead">
                We use 'DataTables' made by @SpryMedia. You can check the full documentation <a href="https://datatables.net/">here</a>.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Basic DataTables</h4>
                            <div class="card-header-action">
                                <a href="tambah.php" class="btn btn-primary">Tambah Data</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Nama Kota</th>
                                            <th>Ongkos Kirim</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data as $row) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?= $no ?>
                                                </td>
                                                <td><?= $row['nama_kota'] ?></td>
                                                <td><?= $row['ongkos_kirim'] ?></td>
                                                <td>
                                                    <a href="lihat.php?id=<?= $row['id_kota'] ?>" class="btn btn-success">Lihat</a>
                                                    <a href="edit.php?id=<?= $row['id_kota'] ?>" class="btn btn-primary">Edit</a>
                                                    <button onclick="hapus(<?= $row['id_kota'] ?>)" class="btn btn-danger">Hapus</button>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        } ?>
                                    </tbody>
                                </table>
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
    "node_modules/datatables/media/js/jquery.dataTables.min.js",
    "node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js",
    "node_modules/sweetalert/dist/sweetalert.min.js",
];
$js_page = [
    "page/datatable.js",
];

$script_page = <<<JS
<script>
    document.title = "Show Kota Kota";
    function hapus(id){
        swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Data berhasil di hapus", {
      icon: "success",
    });
    setTimeout(() => {
        window.location.href = "hapus.php?id="+id;
    }, 2000);
  } 
});
    }
</script>
JS;

include('../layouts/footer.php');
?>
<script>
</script>