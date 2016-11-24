<?php  
session_start();
include_once("db_connection.php");
if (!isset($_SESSION['user'])) {
	header("location: ../view/login.php");
}
else {
	$u = unserialize($_SESSION['user']);
	$id = $_POST['id'];
	$db_connect = db_connect();
	$query = "SELECT * FROM song WHERE songID = $id ";
	$result = mysql_query($query,$db_connect)or die ("Error in query: $query");
	$row = mysql_fetch_array($result);
	$title = $row['title'];
	$name = $row['name'];
	$link = "../data/".$u->userID."/".$name;
	// $link = "../../data/1/Dube.mp3";
		unlink($link);
	$query2 = "DELETE FROM song WHERE songID = $id ";
	$result2 = mysql_query($query2,$db_connect)or die ("Error in query: $query2");
	$row2 = mysql_fetch_array($result2);
	
	db_closeconnect($db_connect);  
	
}
?>