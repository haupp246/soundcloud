<?php  
session_start();
include_once("db_connection.php");
if (!isset($_SESSION['user'])) {
	header("location: ../view/login.php");
}
else {
	$u = unserialize($_SESSION['user']);
	$pl_id = $_POST['pl_id'];
	$song_id = $_POST['song_id'];
	$db_connect = db_connect();
	$query = "DELETE FROM songinplaylist 
			  WHERE songID = {$song_id} and playlistID= {$pl_id} ";
	$result = mysql_query($query,$db_connect)or die ("Error in query: $query");
	//$num_row = mysql_num_rows($result);

	
	
	db_closeconnect($db_connect);  
	
}
?>