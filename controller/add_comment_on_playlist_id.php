<?php  
session_start();
include_once("db_connection.php");
if (!isset($_SESSION['user'])) {
	header("location: ../view/login.php");
} else {
	$u = unserialize($_SESSION['user']);
	$data = $_POST['data'];
    $user_id = $data['userID'];
    $playlist_id = $data['playlistID'];
    $content = $data['content'];
	$db_connect = db_connect();
	$query = "INSERT INTO comment (time, content, userID, playlistID) VALUES (now(), '{$content}', '{$user_id}', '{$playlist_id}')";
    $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
    db_closeconnect($db_connect);

    echo "Complete";
}