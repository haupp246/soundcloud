<?php  
session_start();
include_once("db_connection.php");
if (!isset($_SESSION['user'])) {
	header("location: ../view/login.php");
} else {
	$u = unserialize($_SESSION['user']);
	$content = $_POST['content'];
	$user_id = $u->userID;
	$song_id = $_POST['songID'];
	$db_connect = db_connect();
	$query = "INSERT INTO account (time, content, userID, songID) VALUES (now(), '{$content}', '{$user_id}', '{$song_id}')";
    $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
    db_closeconnect($db_connect);

    echo "Complete";
}