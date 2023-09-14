<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token'])) {
    if ($_POST['csrf_token'] === $_SESSION['csrf_token']) {
        include "mysql_conn.php";
        $mysql_obj = new mysql_conn();
        $mysql = $mysql_obj->GetConn();

        if (isset($_POST['SendBtn'])) {
            include "users.php";
            $user_ubj = new users($mysql);
            $user_ubj->CreateUser($_POST);
        }
    } else {
        die("CSRF validation failed.");
    }
}
$csrfToken = bin2hex(openssl_random_pseudo_bytes(32)); //
$_SESSION['csrf_token'] = $csrfToken;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create User</title>
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

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"],
        button {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="hidden"] {
            display: none;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
        a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            color: #007bff;
            transition: background-color 0.3s, color 0.3s;
        }

        a:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Create User</h2>
    <form action="" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>" />
        <input type="text" name="id" placeholder="<?php echo htmlspecialchars(addslashes('Your ID')); ?>" />
        <input type="text" name="name" placeholder="<?php echo htmlspecialchars(addslashes('Your Name')); ?>" />
        <input type="text" name="mailbox_number" placeholder="<?php echo htmlspecialchars(addslashes('Your Mailbox Number')); ?>" />
        <input type="text" name="phone_number" placeholder="<?php echo htmlspecialchars(addslashes('Your Phone Number')); ?>" />
        <button name="SendBtn" value="1">Send</button>
        <a href="update_table.php">update & delete users from the Table</a>
        <a href="read_table.php">Read the Table</a>
    </form>
</div>
</body>
</html>