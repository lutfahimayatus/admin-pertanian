<?php
class TestController
{
    private $connect;

    function __construct()
    {
        include 'config/connect.php';
        $this->connect = dbConnect();
    }


    public function getAll()
    {
    }

    public function store($request)
    {
        
    }
}
