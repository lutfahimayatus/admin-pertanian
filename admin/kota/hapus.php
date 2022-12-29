<?php
// delete data
if (isset($_GET['id'])) {
    require_once '../controllers/KotaController.php';
    $produkController = new KotaController();
    $produkController->hapus_kota($_GET['id']);
} else {
    header('location: ../404.php');
}
