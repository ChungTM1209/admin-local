<?php
use Controller\UserController;
use Model\User;

require "../model/User.php";
require "../model/UserTable.php";
require "../model/DBConnection.php";
require "../controller/UserController.php";
if ($_POST['user_id']){
    session_start();
    $controller = new UserController();
    $controller->delete($_POST['user_id']);
}
?>
<h1>Xóa tài khoản thành công</h1>
