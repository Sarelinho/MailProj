<?php
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql=$mysql_obj->GetConn();

include "users.php";
$user_ubj = new users($mysql);
if(isset($_GET['SendBtn'])) {
    $user_ubj->UpdateUser($_GET);
    header("location:./userList.php");
}
$mysql=$mysql_obj->GetConn();

$user_obj = new users($mysql);
$uList = $user_obj->GetList();

$id = isset($_GET['rid']) ? $_GET['rid'] : -1;
$row=$user_ubj->GetUser($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Read Table</title>
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
            width: 800px; /* Adjust the width as needed */
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        .return-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Read Table</h1>
    <table>
        <tr>
            <th></th>
            <th>ID</th>
            <th>NAME</th>
            <th>Mailbox Number</th>
            <th>Phone Number</th>
        </tr>
        <?php
        foreach ($uList as $row) { ?>
            <tr>
                <td></td>
                <td><?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?> </td>
                <td><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['mailbox_number'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['phone_number'], ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        <?php } ?>
    </table>
    <a href="./createUsers.php" class="return-link">Return to Create Users</a>
</div>
</body>
</html>