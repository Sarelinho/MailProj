<?php
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql=$mysql_obj->GetConn();

include "users.php";
$user_ubj = new users($mysql);
$user_ubj->DeleteUser($_GET['rid']);
header("location:./update_table.php");
