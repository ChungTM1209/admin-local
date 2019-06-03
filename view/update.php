<?php
use Controller\UserController;
use Model\User;

require "../model/User.php";
require "../model/UserTable.php";
require "../model/DBConnection.php";
require "../controller/UserController.php";
if ($_POST) {
    session_start();
    $editName = $_POST['edit_name'];
    $editJob = $_POST['edit_job'];
    $id = $_POST['user_id'];
    $email = $_SESSION['email'];
    $controller = new UserController();
//    $user = $controller->findByEmail($email);
    $controller->update($id,$editName,$editJob);
    $user = $controller->findById($id);

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#edit").click(function () {
                $("#edit_form").toggle();
            });
            $("#btn_update").click(function (event) {
                event.preventDefault();
                var data = $("#edit_form").serialize();
                $.ajax({
                    type: 'POST',
                    url: 'update.php',
                    data: data,
                    success: function (respone) {
                        $(".container").html(respone);
                    }
                })
            });
            $("#delete").click(function (event) {
                event.preventDefault();
                var user_id = $("#user_id").val();
                $.ajax({
                    type: 'POST',
                    url: 'delete.php',
                    data: user_id,
                    success: function (respone) {
                        $(".container").html(respone);
                    }
                });
            });        });
    </script>
</head>
<body>
<div class="container">
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Email</th>
        <th scope="col">Name</th>
        <th scope="col">Job</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
        <td><?php echo $user->email?></td>
        <td><?php echo $user->name?></td>
        <td><?php echo $user->job?></td>
        <td><button id="edit">Edit</button></td>
        <td><button id="delete">Delete</button></td>
    </tr>

    </tbody>
</table>
<div>
    <form method="get" id="logout">
        <input type="hidden" name="logout" value="logout" hidden>
        <button type="submit" >Log out</button>
    </form>
    <?php
    if ($_GET['logout'] == "logout"){
        $controller->logout();
        header('Location: login.php');
    }
    ?>
</div>
<div  >
    <form  method="post" id="edit_form" style="display: none">
        <input type="hidden" name="user_id" value="<?php echo $user->id?>" >
        <label> Name
            <input type="text" name="edit_name" value="<?php echo $user->name?>">
        </label>
        <label> Job
            <input type="text" name="edit_job" value="<?php echo $user->job?>">
        </label>
        <button type="submit" id="btn_update"> UPDATE</button>
    </form>
</div>