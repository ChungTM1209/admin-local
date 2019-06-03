<?php
use Controller\UserController;

require "../model/User.php";
require "../model/UserTable.php";
require "../model/DBConnection.php";
require "../controller/UserController.php";


$controller = new UserController();
session_start();
    $email = $_POST['email'];
    $password = $_POST["password"];
if ($controller->login($email, $password)) {
    $_SESSION['email'] = $_POST['email'];
    echo 1;
} else {
    echo 0;
}


