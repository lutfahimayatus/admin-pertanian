<?php
// delete data
if (isset($_GET['id'])) {
    require_once '../controllers/PemasokController.php';
    $produkController = new PemasokController();
    $produkController->hapus_pemasok($_GET['id']);
} else {
    header('location: ../404.php');
}
