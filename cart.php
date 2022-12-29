<?php
session_start();
include 'config/connect.php';
// check if login or not
if (!isset($_SESSION['role'])) {
    return header('location: login.php');
}
// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_GET['id_produk'], $_GET['quantity']) && is_numeric($_GET['id_produk']) && is_numeric($_GET['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer

    $id_produk = (int)$_GET['id_produk'];
    $quantity = (int)$_GET['quantity'];

    $data = [
        'id_produk' => $id_produk,
        'quantity' => $quantity
    ];
    require_once 'controllers/CartController.php';
    $cart = new CartController();

    $cart->add_to_cart($data);

    header('location: ' . $_SERVER['HTTP_REFERER']);
}


if (isset($_POST['id_produk'], $_POST['quantity']) && is_numeric($_POST['id_produk']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $id_produk = (int)$_POST['id_produk'];
    $quantity = (int)$_POST['quantity'];

    $data = [
        'id_produk' => $id_produk,
        'quantity' => $quantity
    ];
    require_once 'controllers/CartController.php';
    $cart = new CartController();

    echo   $cart->add_to_cart($data);
}
