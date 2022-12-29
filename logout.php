<?php
include 'config/connect.php';
require_once 'controllers/AuthController.php';
$auth = new AuthController();
$auth->logout();
