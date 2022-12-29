<?php
class PemasokController
{
    protected $connect;

    function __construct()
    {
        include '../config/connect.php';
        $this->connect = dbConnect();
    }

    function ambil_pemasok()
    {
        $sql = "SELECT * FROM pemasok";
        $result = mysqli_query($this->connect, $sql);
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    function lihat_pemasok($id)
    {
        $sql = "SELECT * FROM pemasok WHERE id_pemasok = $id LIMIT 1";
        $result = mysqli_query($this->connect, $sql);
        $row = [];
        if ($result) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        } else {
            return header('location: ../404.php');
        }
        return $row;
    }

    function tambah_pemasok($request)
    {
        if (isset($request['submit_data'])) {
            // assign to variable
            $nama_pemasok = $request['nama'];
            $no_telp = $request['no_telp'];
            $email = $request['email'];
            $alamat = $request['alamat'];
            $nama_pemasok = htmlspecialchars($nama_pemasok);
            $no_telp = htmlspecialchars($no_telp);
            $email = htmlspecialchars($email);
            $alamat = htmlspecialchars($alamat);

            // validation for no_telp and email
            if (!is_numeric($no_telp)) {
                $error = "No telp harus berupa angka";
                $_SESSION['input_error']['no_telp'] = $error;
                return header("location: tambah.php");
            }

            // insert to database
            $sql = "INSERT INTO pemasok (nama_pemasok, no_telp, email, alamat) VALUES ('$nama_pemasok', '$no_telp', '$email', '$alamat' )";
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

    public function update_pemasok($id, $request)
    {
        if (isset($request['submit_data'])) {
            $nama_pemasok = $request['nama'];
            $no_telp = $request['no_telp'];
            $email = $request['email'];
            $alamat = $request['alamat'];
            $nama_pemasok = htmlspecialchars($nama_pemasok);
            $no_telp = htmlspecialchars($no_telp);
            $email = htmlspecialchars($email);
            $alamat = htmlspecialchars($alamat);

            // validation for no_telp and email
            if (!is_numeric($no_telp)) {
                $error = "No telp harus berupa angka";
                $_SESSION['input_error']['no_telp'] = $error;
                return header("location: tambah_pemasok.php");
            }

            // update to database
            $sql = "UPDATE pemasok SET nama_pemasok = '$nama_pemasok', no_telp = '$no_telp', email = '$email', alamat = '$alamat' WHERE id_pemasok = '$id'";

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

    public function hapus_pemasok($id)
    {
        echo $id;
        $result = mysqli_query($this->connect, "DELETE FROM pemasok WHERE id_pemasok = $id");
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
