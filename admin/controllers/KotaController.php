<?php
class KotaController
{
    protected $connect;

    function __construct()
    {
        include '../config/connect.php';
        $this->connect = dbConnect();
    }

    function ambil_kota()
    {
        $sql = "SELECT * FROM kota";
        $result = mysqli_query($this->connect, $sql);
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    function lihat_kota($id)
    {
        $sql = "SELECT * FROM kota WHERE id_kota = $id LIMIT 1";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if (!$row) header('location: ../404.php');
        return $row;
    }

    function tambah_kota($request)
    {
        if (isset($request['submit_data'])) {
            // assign to variable
            $nama_kota = $request['nama'];
            $ongkos_kirim = $request['ongkos_kirim'];
            $nama_kota = htmlspecialchars($nama_kota);
            $ongkos_kirim = htmlspecialchars($ongkos_kirim);

            // validation for ongkos_kirim and email
            if (!is_numeric($ongkos_kirim)) {
                $error = "Ongkos kirim harus berupa angka";
                $_SESSION['input_error']['ongkos_kirim'] = $error;
                return header("location: tambah.php");
            } else {
                $_SESSION['input_error']['ongkos_kirim'] = "";
            }

            // insert to database
            $sql = "INSERT INTO kota (nama_kota, ongkos_kirim) VALUES ('$nama_kota', '$ongkos_kirim')";
            try {
                $result = mysqli_query($this->connect, $sql);
                if ($result) {
                    $_SESSION['success'] = "Data berhasil ditambahkan";
                    return header("Location: lihat.php?id=" . mysqli_insert_id($this->connect));
                } else {
                    $_SESSION['error'] = "Data gagal ditambahkan";
                    return header("Location: tambah.php");
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }
    }

    public function update_kota($id, $request)
    {
        if (isset($request['submit_data'])) {
            $nama_kota = $request['nama'];
            $ongkos_kirim = $request['ongkos_kirim'];
            $nama_kota = htmlspecialchars($nama_kota);
            $ongkos_kirim = htmlspecialchars($ongkos_kirim);

            // validation for ongkos_kirim and email
            if (!is_numeric($ongkos_kirim)) {
                $error = "Ongkos kirim harus berupa angka";
                $_SESSION['error_ongkos_kirim'] = $error;
                header("location: tambah_kota.php");
            }
            // update to database
            $sql = "UPDATE kota SET nama_kota = '$nama_kota', ongkos_kirim = '$ongkos_kirim' WHERE id_kota = '$id'";

            try {
                $result = mysqli_query($this->connect, $sql);
                if ($result) {
                    $_SESSION['success'] = "Data berhasil diubah";
                    return header("Location: lihat.php?id=" . $id);
                } else {
                    $_SESSION['error'] = "Data gagal diubah";
                    return header("Location: index.php");
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }
    }

    public function hapus_kota($id)
    {
        echo $id;
        $result = mysqli_query($this->connect, "DELETE FROM kota WHERE id_kota = $id");
        if ($result) {
            // delete images from assets/img
            $_SESSION['success'] = "Data berhasil dihapus";
            return header("Location: index.php");
        } else {
            $_SESSION['error'] = "Data gagal dihapus";
            return header("Location: index.php");
        }
    }
}
