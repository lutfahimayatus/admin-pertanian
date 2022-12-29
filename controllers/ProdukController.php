<?php
class ProdukController
{
    protected $connect;

    function __construct()
    {
        $this->connect = dbConnect();
    }

    function ambil_produk()
    {
        $sql = "SELECT * FROM produk ORDER BY stok DESC LIMIT 6";
        $result = mysqli_query($this->connect, $sql);
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    function lihat_produk($id)
    {
        $sql = "SELECT * FROM produk WHERE id_produk = $id LIMIT 1";
        $result = mysqli_query($this->connect, $sql);
        $row = [];

        // check if result is not empty
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        } else {
            header('location: 404.php');
        }

        return $row;
    }

    function random_list_produk()
    {
        $sql = "SELECT * FROM produk ORDER BY RAND() LIMIT 3";
        $result = mysqli_query($this->connect, $sql);
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    function update_stok($id, $stok)
    {
        $sql = "UPDATE produk SET stok = $stok WHERE id_produk = $id";
        $result = mysqli_query($this->connect, $sql);

        return $result;
    }

    function tambah_produk($request)
    {
        if (isset($request['submit_data'])) {

            // assign to variable
            $nama_produk = $request['nama'];
            $harga_produk = $request['harga'];
            $stok_produk = $request['stok'];
            $deskripsi = $request['deskripsi'];
            $nama_produk = htmlspecialchars($nama_produk);
            $harga_produk = htmlspecialchars($harga_produk);
            $stok_produk = htmlspecialchars($stok_produk);
            $deskripsi = htmlspecialchars($deskripsi);
            $images = [];

            // validation for harga and stok
            if (!is_numeric($harga_produk)) {
                $error = "Harga harus berupa angka";
                $_SESSION['input_error']['harga'] = $error;
                header("location: tambah.php");
                return;
            } else if (!is_numeric($stok_produk)) {
                $error = "Stok harus berupa angka";
                $_SESSION['input_error']['stok'] = $error;
                header("location: tambah.php");
                return;
            }

            if (isset($_FILES["gambar"])) {
                $target_file = '';
                // extract array of images from $_FILES and store to assets/img
                $uploadOk = 1;
                for ($i = 0; $i < count($_FILES["gambar"]["name"]); $i++) {
                    $target_dir = "../assets/images/produk/";
                    $filename = $_FILES["gambar"]["name"][$i];
                    $target_file = $target_dir . basename($_FILES["gambar"]["name"][$i]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Check if image file is a actual image or fake image
                    if (isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["gambar"]["tmp_name"][$i]);
                        if ($check !== false) {
                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                    }

                    // Check file size
                    if ($_FILES["gambar"]["size"][$i] > 500000) {
                        $_SESSION['input_error']['image'] = "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if (
                        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif"
                    ) {
                        $_SESSION['input_error']['image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        $_SESSION['input_error']['image'] = "Sorry, your file was not uploaded.";

                        // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["gambar"]["tmp_name"][$i], $target_file)) {
                            // $_SESSION['input_error']['image'] = "The file " . basename($_FILES["gambar"]["name"][$i]) . " has been uploaded.";
                            array_push($images, $filename);
                        } else {
                            $_SESSION['input_error']['image'] = "Sorry, there was an error uploading your file.";
                        }
                    }
                }
                $images = implode(',', $images);
            }

            // insert to database
            $sql = "INSERT INTO produk (nama_produk, harga, stok, deskripsi_produk, gambar) VALUES ('$nama_produk', '$harga_produk', '$stok_produk', '$deskripsi', '$images')";
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

    public function update_produk($id, $request)
    {
        if (isset($request['submit_data'])) {
            $nama_produk = $request['nama'];
            $harga_produk = $request['harga'];
            $stok_produk = $request['stok'];
            $deskripsi = $request['deskripsi'];
            $nama_produk = htmlspecialchars($nama_produk);
            $harga_produk = htmlspecialchars($harga_produk);
            $stok_produk = htmlspecialchars($stok_produk);
            $deskripsi = htmlspecialchars($deskripsi);
            $images = [];

            // validation for harga and stok
            if (!is_numeric($harga_produk)) {
                $error = "Harga harus berupa angka";
                $_SESSION['input_error']['harga'] = $error;
                header("location: tambah_produk.php");
            } else if (!is_numeric($stok_produk)) {
                $error = "Stok harus berupa angka";
                $_SESSION['input_error']['stok'] = $error;
                header("location: tambah_produk.php");
            }

            if (isset($_FILES["gambar"])) {
                $target_file = '';
                // extract array of images from $_FILES and store to assets/img
                $uploadOk = 1;
                for ($i = 0; $i < count($_FILES["gambar"]["name"]); $i++) {
                    $target_dir = "../assets/images/produk/";
                    $filename = $_FILES["gambar"]["name"][$i];
                    $target_file = $target_dir . basename($_FILES["gambar"]["name"][$i]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image
                    if (isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["gambar"]["tmp_name"][$i]);
                        if ($check !== false) {
                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                    }
                    // Check file size
                    if ($_FILES["gambar"]["size"][$i] > 500000) {
                        $_SESSION['input_error']['image'] = "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if (
                        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif"
                    ) {
                        $_SESSION['input_error']['image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        $_SESSION['input_error']['image'] = "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["gambar"]["tmp_name"][$i], $target_file)) {
                            // $_SESSION['success'] = "The file " . basename($_FILES["gambar"]["name"][$i]) . " has been uploaded.";
                            array_push($images, $filename);
                        } else {
                            $_SESSION['input_error']['image'] = "Sorry, there was an error uploading your file.";
                        }
                    }

                    $images = implode(',', $images);

                    // update to database
                    $sql = "UPDATE produk SET nama_produk = '$nama_produk', harga = '$harga_produk', stok = '$stok_produk', deskripsi_produk = '$deskripsi', gambar = '$images' WHERE id_produk = '$id'";

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
        }
    }

    public function hapus_produk($id)
    {
        $result = mysqli_query($this->connect, "DELETE FROM produk WHERE id_produk = $id");
        if ($result) {
            // delete images from assets/img
            $images = mysqli_query($this->connect, "SELECT gambar FROM produk WHERE id_produk = $id");
            $images = mysqli_fetch_assoc($images);
            $images = explode(',', $images['gambar']);
            foreach ($images as $image) {
                unlink("../assets/images/produk/" . $image);
            }
            $_SESSION['success'] = "Data berhasil dihapus";
            return header("Location: index.php");
        } else {
            $_SESSION['error'] = "Data gagal dihapus";
            return header("Location: index.php");
        }
    }

    public function cari_produk($cari)
    {
        $sql = "SELECT * FROM produk WHERE nama_produk LIKE '%$cari%' OR harga LIKE '%$cari%' OR stok LIKE '%$cari%' OR deskripsi_produk LIKE '%$cari%'";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
}
