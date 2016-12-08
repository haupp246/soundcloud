<?php
include_once("db_connection.php");
session_start();
if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
}
if(isset($_SESSION['user'])) $u = unserialize($_SESSION['user']);
include_once("db_connection.php");
$db_connect = db_connect();
//$query = "SELECT playlistID FROM playlist ORDER BY playlistID DESC LIMIT 1";
//$result = mysql_query($query,$db_connect)or die("Error in query $query");
//$row = mysql_fetch_assoc($result);
$playlistID = $_GET['id'];
$songID = $_POST['songs'];
foreach ($songID as $songs) {
    echo $songs . "<br />";
    $query = "INSERT IGNORE INTO songinplaylist (songID, playlistID) VALUES ('$songs', '$playlistID')";
    $result = mysql_query($query,$db_connect)or die("Error in query $query");
    echo "Success";

}
db_closeconnect($db_connect);
header("location: edit_playlist.php?id=$playlistID");
?>