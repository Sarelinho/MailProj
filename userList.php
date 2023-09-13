<?php
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql=$mysql_obj->GetConn();

include "users.php";
$user_ubj = new users($mysql);
if(isset($_GET['SendBtn'])) {
    $user_ubj->UpdateUser($_GET);
     header("location:./update_table.php");

}

$id = isset($_GET['rid']) ? $_GET['rid'] : -1;
echo $id;
$row=$user_ubj->GetUser($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update User</title>
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
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="hidden"] {
            display: none;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Update User</h1>
    <form action="" method="get">
        <input type="text" name="id" value="<?= $row['id'] ?>" />
        <input type="text" name="name" value="<?= $row['name'] ?>" />
        <input type="text" name="mailbox_number" value="<?= $row['mailbox_number'] ?>" />
        <input type="text" name="phone_number" value="<?= $row['phone_number'] ?>" />
        <button name="SendBtn" value="1">Send</button>
    </form>
</div>
</body>
</html>