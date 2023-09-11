<?php
session_start();
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql=$mysql_obj->GetConn();
include "users.php";
$users_obj=new users($mysql);

$gss=isset($_SESSION['gss']) ? $_SESSION['gss'] : 0;
if(isset($_GET['btnPressed'])) {
    $pass = (isset($_GET['pass'])) ? $_GET['pass'] : "";
    if (($gss < 4) && ($users_obj->IsValid($pass))) {
        header("location:createUsers.php");
    }
    else{
        setcookie("MyUser",0);
        echo "try again";
        $gss++;
    }
}
$_SESSION['gss']=$gss;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        .container h2 {
            margin-bottom: 20px;
        }

        .container input[type="text"],
        .container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .container button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form action="" method="get">

        <input type="password" name="pass" placeholder=" Enter a Password" />
        <br>
        <button name="btnPressed" value="1">Login</button>
    </form>
</div>
</body>