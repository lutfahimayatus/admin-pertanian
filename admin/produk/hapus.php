<?php
// delete data
if (isset($_GET['id'])) {
    require_once '../controllers/KotaController.php';
    $kotaController = new KotaController();
    $kotaController->hapus_kota($_GET['id']);
} else {
    header('location: ../404.php');
}
