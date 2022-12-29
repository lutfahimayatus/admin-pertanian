<?php
class KotaController
{
    protected $connect;

    function __construct()
    {
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

    function ambil_kota_by_id($id)
    {
        $sql = "SELECT * FROM kota WHERE id_kota = $id";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return $row;
    }
}
