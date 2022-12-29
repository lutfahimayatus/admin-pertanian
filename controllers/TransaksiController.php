<?php

require_once 'controllers/ProdukController.php';

class TransaksiController
{
    protected $connect;

    function __construct()
    {
        $this->connect = dbConnect();
    }

    function checkout($request)
    {
        $status_transaksi = 'PENDING';
        if (isset($_FILES['bukti_transfer'])) {
            // upload and asve to database
            $bukti_transfer = $_FILES['bukti_transfer']['name'];
            $tmp = $_FILES['bukti_transfer']['tmp_name'];
            $path = "admin/assets/images/bukti_transfer/" . $bukti_transfer;
            move_uploaded_file($tmp, $path);

            $status_transaksi = 'BELUM_BAYAR';
        } else {
            $error = "Bukti transfer harus diisi";
            $_SESSION['error'] = $error;
            return header('Location: payment.php');
        }

        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        } else {
            $cart = [];
        }
        $cart_ = new CartController();
        $data_cart = $cart_->get_produk_by_cart($cart);

        // generate id_transaksi
        $id_transaksi = "TRX" . date('YmdHis');
        $tanggal_transaksi = date('Y-m-d H:i:s');
        $total_bayar = $data_cart['total'];
        $id_kota = $_SESSION['id_kota'];
        $id_user = $_SESSION['id_user'];

        // insert to transaksi table and get id_transaksi
        $query = "INSERT INTO transaksi (id_transaksi, tanggal_transaksi, total_bayar, id_user, id_kota, bukti_transaksi, status_transaksi) VALUES ('$id_transaksi', '$tanggal_transaksi', $total_bayar, $id_user, $id_kota, '$bukti_transfer', '$status_transaksi')";
        $result = mysqli_query($this->connect, $query);
        // get id_transaksi
        $id_transaksi = mysqli_insert_id($this->connect);
        if ($id_transaksi) {
            // insert to detail_transaksi table
            foreach ($data_cart['data'] as $key => $value) {
                $id_produk = $value['id_produk'];
                $qty = $value['qty'];
                $total_harga = $qty * $value['harga'];
                $query = "INSERT INTO detail_transaksi (id_produk, id_transaksi, qty, total_harga) VALUES ($id_produk, $id_transaksi, $qty, $total_harga)";
                $result = mysqli_query($this->connect, $query);
                if ($result) {
                    // remove cart
                }
            }
        }

        unset($_SESSION['cart']);
        return header('Location: after-payment.php');
    }

    function get_order_list()
    {
        $id_user = null;
        if (isset($_SESSION['id_user'])); {
            $id_user = $_SESSION['id_user'];
        }
        $query = "SELECT * FROM detail_transaksi INNER JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi INNER JOIN produk ON produk.id_produk = detail_transaksi.id_produk WHERE transaksi.id_user = $id_user ORDER BY tanggal_transaksi DESC";
        $result = mysqli_query($this->connect, $query);

        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    function get_order_by_id($request)
    {
        $id_user = null;
        $id_transaksi = $request['id_transaksi'];
        if (isset($_SESSION['id_user'])); {
            $id_user = $_SESSION['id_user'];
        }
        $query = "SELECT * FROM transaksi WHERE id_user = $id_user AND id_transaksi = $id_transaksi";
        $result = mysqli_query($this->connect, $query);

        $row = [];

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }

        return $row;
    }

    function get_order()
    {
        $id_user = null;
        if (isset($_SESSION['id_user'])); {
            $id_user = $_SESSION['id_user'];
        }
        $query = "SELECT * FROM transaksi WHERE id_user = $id_user ORDER BY tanggal_transaksi DESC";
        $result = mysqli_query($this->connect, $query);

        $row = [];

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }

        return $row;
    }

    function update_transaksi($id)
    {
        // if(isset($request['submit_data']){ 
        //     $no_resi = $request['no_resi'];
        // })
    }
}
