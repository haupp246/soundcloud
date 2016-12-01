<?php
include_once("db_connection.php");
session_start();
if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
}
if(isset($_SESSION['user'])) $u = unserialize($_SESSION['user']);
$db_connect = db_connect();
$name=$_POST['name'];
$query = "INSERT INTO playlist (name, createTime, userID) VALUES ('{$name}',NOW(),$u->userID)";
$result = mysql_query($query,$db_connect)or die ("Error in query: $query");
	//$num_row = mysql_num_rows($result);

	//echo "ok";
	
db_closeconnect($db_connect);  
	
?>