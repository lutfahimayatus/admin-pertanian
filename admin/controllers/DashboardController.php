+<?php
class DashboardController
{
    protected $connect;

    function __construct()
    {
        $this->connect = dbConnect();
    }

    function ambil_penjualan()
    {
        // get count of transaksi sukses
        $sql = "SELECT COUNT(*) AS total FROM transaksi WHERE status_transaksi = 'SUKSES'";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $total_sukses = $row['total'];

        // reset 
        $row = [];

        // get count of transaksi gagal
        $sql = "SELECT COUNT(*) AS total FROM transaksi WHERE status_transaksi = 'GAGAL'";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $total_gagal = $row['total'];

        // reset 
        $row = [];

        // get count of transaksi belum_bayar
        $sql = "SELECT COUNT(*) AS total FROM transaksi WHERE status_transaksi = 'BELUM_BAYAR'";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $total_belum_bayar = $row['total'];

        // reset 
        $row = [];

        // get count of transaksi total
        $sql = "SELECT COUNT(*) AS total FROM transaksi";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $total_penjualan = $row['total'];

        // reset 
        $row = [];

        // get count of transaksi pending
        $sql = "SELECT COUNT(*) AS total FROM transaksi WHERE status_transaksi = 'PENDING'";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $total_pending = $row['total'];

        // reset 
        $row = [];

        // get revenue of transaksi sukses
        $sql = "SELECT SUM(total_bayar
        ) AS total FROM transaksi WHERE status_transaksi = 'SUKSES'";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $total_revenue = $row['total'];



        $data = [
            'total_sukses' => $total_sukses,
            'total_gagal' => $total_gagal,
            'total_pending' => $total_pending,
            'total_belum_bayar' => $total_belum_bayar,
            'total_penjualan' => $total_penjualan,
            'total_revenue' => $total_revenue,
        ];

        return $data;
    }

    function ambil_top_product()
    {
        $sql = "SELECT * FROM produk ORDER BY terjual DESC LIMIT 5";
        $result = mysqli_query($this->connect, $sql);
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }


    function ambil_top_product_by_kota()
    {
        $sql = "SELECT * FROM transaksi INNER JOIN kota ON transaksi.id_kota = kota.id_kota GROUP BY kota.id_kota ORDER BY COUNT(transaksi.id_kota) DESC LIMIT 5";
        $result = mysqli_query($this->connect, $sql);
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    function ambil_latest_transaksi()
    {
        $sql = "SELECT * FROM transaksi ORDER BY id_transaksi DESC LIMIT 5";
        $result = mysqli_query($this->connect, $sql);
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }


    function ambil_kota_by_id($id)
    {
        $sql = "SELECT * FROM kota WHERE id_kota = $id";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return $row;
    }
}