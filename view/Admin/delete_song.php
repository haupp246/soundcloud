<?php
session_start();
include_once("../../controller/db_connection.php");
$db_connect = db_connect();
$songID = $_GET['id'];
$query = "DELETE FROM song WHERE songID = '$songID'";
$result = mysql_query($query,$db_connect) or die ("Error in query: $query");
header("location: /soundcloud/view/Admin/index.php");
db_closeconnect($db_connect);
?>