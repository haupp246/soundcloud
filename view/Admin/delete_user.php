<?php
session_start();
include_once("../../controller/db_connection.php");
$db_connect = db_connect();
$email = $_GET['email'];
$query = "DELETE FROM account WHERE email = '$email'";
$result = mysql_query($query,$db_connect) or die ("Error in query: $query");
header("location: /soundcloud/view/Admin/index.php");
db_closeconnect($db_connect);
?>