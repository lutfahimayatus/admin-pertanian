<?php

class CartController
{
    protected $connect;

    function __construct()
    {
        $this->connect = dbConnect();
    }

    function add_to_cart($request)
    {
        $id_produk  = (int)$request['id_produk'];
        $quantity = (int)$request['quantity'];

        $sql = "SELECT * FROM produk WHERE id_produk = $id_produk ";
        $result = mysqli_query($this->connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                if (array_key_exists($id_produk, $_SESSION['cart'])) {
                    $_SESSION['cart'][$id_produk] += $quantity;
                } else {
                    $_SESSION['cart'][$id_produk] = $quantity;
                }
            } else {
                $_SESSION['cart'] = array($id_produk => $quantity);
            }
            return true;
        }
    }

    function add_to_buy($request)
    {
        $id_produk  = (int)$request['id_produk'];
        $quantity = (int)$request['quantity'];

        $sql = "SELECT * FROM produk WHERE id_produk = $id_produk ";
        $result = mysqli_query($this->connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            if (isset($_SESSION['beli_sekarang']) && is_array($_SESSION['beli_sekarang'])) {
                if (array_key_exists($id_produk, $_SESSION['beli_sekarang'])) {
                    $_SESSION['beli_sekarang'][$id_produk] += $quantity;
                } else {
                    $_SESSION['beli_sekarang'][$id_produk] = $quantity;
                }
            } else {
                $_SESSION['beli_sekarang'] = array($id_produk => $quantity);
            }
            return true;
        }
    }
    public function get_produk_by_buy($data)
    {
        $result_data = array(
            'data' => array(),
            'total' => 0
        );

        foreach ($data as $id_produk => $qty) {
            $sql = "SELECT * FROM produk WHERE id_produk = $id_produk";
            $result = mysqli_query($this->connect, $sql);
            $row = mysqli_fetch_assoc($result);
            $gambar = explode(',', $row['gambar']);
            $data = array(
                'id_produk' => $row['id_produk'],
                'nama_produk' => $row['nama_produk'],
                'harga' => $row['harga'],
                'gambar' => $gambar[0],
                'qty' => $qty,
                'total' => $row['harga'] * $qty
            );

            array_push($result_data['data'], $data);
            $result_data['total'] += $row['harga'] * $qty;
        }

        return $result_data;
    }
    
    public function get_produk_by_cart($data)
    {
        $result_data = array(
            'data' => array(),
            'total' => 0
        );
        foreach ($data as $id_produk => $qty) {
            $sql = "SELECT * FROM produk WHERE id_produk = $id_produk";
            $result = mysqli_query($this->connect, $sql);
            $row = mysqli_fetch_assoc($result);
            $gambar = explode(',', $row['gambar']);
            $data = array(
                'id_produk' => $row['id_produk'],
                'nama_produk' => $row['nama_produk'],
                'harga' => $row['harga'],
                'gambar' => $gambar[0],
                'qty' => $qty,
                'total' => $row['harga'] * $qty
            );


            array_push($result_data['data'], $data);
        }
        // get total price
        $total = 0;
        foreach ($result_data['data'] as $data) {
            $total += $data['total'];
        }
        $result_data['total'] = $total;

        return $result_data;
    }

    public function get_number_cart()
    {
        $number = 0;
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id_produk => $qty) {
                // only count the number of items, not the quantity
                $number++;
            }
            return $number;
        }
    }


    function checkout($data)
    {
        $id_user = $_SESSION['id_user'];
        $tanggal_transaksi = date('Y-m-d');

        foreach ($data as $key => $value) {
            $id_transaksi = "INSERT INTO transaksi (id_user, tanggal_transaksi, total_bayar) VALUES ($id_user, '$tanggal_transaksi', $value)";
            $result = mysqli_query($this->connect, $id_transaksi);

            if ($result) {
                $id_transaksi = mysqli_insert_id($this->connect);
                $id_produk = $value['id_produk'];
                $total_order = $value['total'];
                $status_pesanan = 'belum bayar';
                $tanggal_order = date('Y-m-d');
                $jam_order = date('H:i:s');
                $no_telp = $_SESSION['no_telp'];
                $alamat = $_SESSION['alamat'];
                $id_kota = $_SESSION['id_kota'];

                $detail_transaksi = "INSERT INTO detail_transaksi (id_transaksi, id_user, id_produk, total_order, status_pesanan, tanggal_order, jam_order, no_telp, alamat, id_kota) VALUES ($id_transaksi, $id_user, $id_produk, $total_order, '$status_pesanan', '$tanggal_order', '$jam_order', '$no_telp', '$alamat', $id_kota)";
                $result = mysqli_query($this->connect, $detail_transaksi);
                if ($result) {
                    echo "berhasil";
                } else {
                    echo "gagal";
                }
            }
        }
    }

    function remove_cart($id_produk)
    {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($id_produk, $_SESSION['cart'])) {
                unset($_SESSION['cart'][$id_produk]);
            }

            return true;
        }
    }
}
