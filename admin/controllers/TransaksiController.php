<?php

require_once 'ProdukController.php';

class TransaksiController
{
    protected $connect;

    function __construct()
    {
        include '../config/connect.php';
        $this->connect = dbConnect();
    }

    function ambil_transaksi()
    {
        $query = "SELECT * FROM detail_transaksi INNER JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi INNER JOIN produk ON produk.id_produk = detail_transaksi.id_produk INNER JOIN kota ON kota.id_kota = transaksi.id_kota GROUP BY transaksi.id_transaksi ORDER BY tanggal_transaksi DESC ";
        $result = mysqli_query($this->connect, $query);

        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    function lihat_transaksi($id)
    {
        $sql =   "SELECT * FROM detail_transaksi INNER JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi INNER JOIN produk ON produk.id_produk = detail_transaksi.id_produk INNER JOIN kota ON kota.id_kota = transaksi.id_kota WHERE transaksi.id_transaksi = $id";
        $result = mysqli_query($this->connect, $sql);
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }
}