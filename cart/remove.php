<?php
session_start();
include_once '../config/connect.php';
// If the user clicked the remove button on the product page we can remove it from the shopping cart
if (isset($_POST['id_produk']) && is_numeric($_POST['id_produk'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $id_produk = (int)$_POST['id_produk'];

    require_once '../controllers/CartController.php';
    $cart = new CartController();
    $remove_cart = $cart->remove_cart($id_produk);
    header('location: ' . $_SERVER['HTTP_REFERER']);
    return $remove_cart;
}
