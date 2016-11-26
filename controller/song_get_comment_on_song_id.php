<?php  
session_start();
include_once("db_connection.php");
if (!isset($_SESSION['user'])) {
	header("location: ../view/login.php");
} else {
	$u = unserialize($_SESSION['user']);
	$song_id = json_decode($_POST['songID']);
	$db_connect = db_connect();
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET SESSION collation_connection = 'utf8_unicode_ci'");

	$query = "SELECT cmtID, time, content, c.userID AS commentUserID, songID,
				u.userID, name, avatar
	 		FROM comment AS c 
	 		JOIN user AS u ON c.userID = u.userID 
	 		WHERE c.songID = $song_id";
	$result = mysql_query($query,$db_connect)or die ("Error in query: $query");
	$i = 0;
	while ($row = mysql_fetch_array($result)) {
		$comments[$i]['cmtID'] 			= $row['cmtID'];
		$comments[$i]['time'] 			= $row['time'];
		$comments[$i]['content'] 		= $row['content'];
		$comments[$i]['commentUserID'] 	= $row['commentUserID'];
		$comments[$i]['songID'] 		= $row['songID'];
		$comments[$i]['userID'] 		= $row['userID'];
		$comments[$i]['name'] 			= $row['name'];
		$comments[$i]['avatar'] 		= $row['avatar'];
		$i++;
	}
	echo json_encode($comments);
}