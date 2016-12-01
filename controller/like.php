<?php
session_start();
include_once("db_connection.php");
if (!isset($_SESSION['user'])) {
    header("location: ../view/login.php");
}
else {
    $u = unserialize($_SESSION['user']);
    $songID = $_POST['id'];
    $db_connect = db_connect();
    $query = "SELECT * FROM likesong WHERE userID = {$u->userID} and songID = {$songID}";
    $result = mysql_query($query,$db_connect)or die ("Error in query: $query");
    $num_row = mysql_num_rows($result);
    if ($num_row==0)
    {
        $query = "INSERT INTO likesong (userID, songID) VALUES ({$u->userID},{$songID})";
        $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
        $query = "UPDATE song SET likeCount=likeCount+1 WHERE songID={$songID}";
        $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
    }
    else
    {
        $query = "DELETE FROM likesong WHERE userID = {$u->userID} AND songID = {$songID}";
        $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
        $query = "UPDATE song SET likeCount=likeCount-1 WHERE songID={$songID}";
        $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
    }

    $query = "SELECT * FROM song WHERE songID = {$songID}";
    $result = mysql_query($query,$db_connect)or die ("Error in query: $query");
    $row = mysql_fetch_array($result);
    $like_count = $row['likeCount'];
    db_closeconnect($db_connect);

    echo $like_count;
}
?>