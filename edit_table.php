<?php
session_start();
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql=$mysql_obj->GetConn();
include "users.php";
$users_obj=new users($mysql);

if(isset($_GET['SendBtn'])) {
    $users_obj->UpdateUser($_GET);
    header("location:./UsersList_SSR_OOP.php");
}

$id = isset($_GET['rid']) ? $_GET['rid'] : -1;
    $row=$users_obj->GetUser($id);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>update user</title>
</head>
<body>
<h1>update user</h1>
<form action="" method="get">
    <input type="hidden" name="id" value="<?= $id ?>" />
    <input type="text" name="username" value="<?= $row['username'] ?>" />
    <br>
    <input type="text" name="valid_until" value="<?= $row['valid_until'] ?>" />
    <br>
    <button name="SendBtn" value="1">send</button>
</form>
</body>
</html>
