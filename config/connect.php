<?php
// create class connect php mysqli database

function dbConnect()
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "admin_pertanian";
    try {
        // connect to db with mysqli
        $conn = mysqli_connect($host, $user, $pass, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
    }
}
