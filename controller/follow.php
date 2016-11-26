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
	$query = "SELECT * FROM follow WHERE userID1 = {$u->userID} and userID2 = {$id} ";
	$result = mysql_query($query,$db_connect)or die ("Error in query: $query");
	$num_row = mysql_num_rows($result);
	if ($num_row==0)
	{
		$query = "INSERT INTO follow (userID1, userID2) VALUES ({$u->userID},{$id})";
        $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
        $query = "UPDATE user SET followercount=followercount+1 WHERE userID={$id}";
        $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
	}
	else 
	{
		$query = "DELETE FROM follow WHERE userID1 = {$u->userID} and userID2 = {$id}";
        $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
        $query = "UPDATE user SET followercount=followercount-1 WHERE userID={$id}";
        $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
	}
	
	
	db_closeconnect($db_connect);  
	
}
?>