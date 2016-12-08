<?php
session_start();
include_once("db_connection.php");
if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
}
if(isset($_SESSION['user'])) $u = unserialize($_SESSION['user']);
include_once("db_connection.php");
$db_connect = db_connect();
//$playlistID = $_SESSION['playlistID'];
$playlistID = $_GET['id'];
$query = "DELETE FROM playlist WHERE playlistID='$playlistID'";
$result =  mysql_query($query,$db_connect) or die ("Error $querry");
db_closeconnect($db_connect);
//header("location: ../view/Users/myplaylist.php");
header("location: ../view/Users/index.php");
?>