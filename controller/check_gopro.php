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
	// $query = "SELECT * FROM songinplaylist inner join playlist 
	// 		  on songinplaylist.playlistID = playlist.playlistID
	// 		  WHERE songID = {$song_id} and playlist.name = '{$pl_name}' ";
	$query = "UPDATE user SET ispro=1 where userID='$id'";
	$result = mysql_query($query,$db_connect)or die ("Error in query: $query");
	//$num_row = mysql_num_rows($result);

	//echo "ok";
	
	db_closeconnect($db_connect);  
	
}
?>