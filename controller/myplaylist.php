<?php
include_once("db_connection.php");
session_start();
if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
}
if(isset($_SESSION['user'])) $u = unserialize($_SESSION['user']);
$db_connect = db_connect();
$query = "SELECT playlistID FROM playlist ORDER BY playlistID DESC LIMIT 1";
$result = mysql_query($query,$db_connect)or die("Error in query $query");
$row = mysql_fetch_assoc($result);
$playlistID = $row["playlistID"];
$choose = $_POST['songs'];
foreach ($choose as $songs) {
    echo $songs . "<br />";
    $query = "INSERT INTO songinplaylist (songID, playlistID) VALUES ('$songs','$playlistID')";
    $result = mysql_query($query,$db_connect)or die("Error in query $query");
}
header("location:../view/Users/index.php")
?>