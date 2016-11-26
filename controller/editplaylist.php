<?php
include_once("db_connection.php");
session_start();
if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
}
if(isset($_SESSION['user'])) $u = unserialize($_SESSION['user']);
$db_connect = db_connect();
$playlistID = $_GET['id'];
$_SESSION['playlistID'] = $playlistID;
$query = "SELECT * FROM playlist WHERE playlistID = '$playlistID' ";
$result = mysql_query($query,$db_connect)or die("Error in query $query");
$row = mysql_fetch_array($result);
if ($row['userID'] != $u->userID) echo "DM co cl ik";
else{
    $query = "SELECT B.`name`, B.`songID` 
              FROM `songinplaylist` AS A
              INNER JOIN `song` AS B ON A.`songID` = B.`songID`
              WHERE A.`playlistID`='$playlistID'";
    $result = mysql_query($query,$db_connect)or die("Error in query $query");
    $num_row = mysql_num_rows($result);
//    echo"<a href=\"/soundcloud/controller/editplaylist.php?id=".$id."\">"."edit</a>";
    echo "<form method='post' action=\"/soundcloud/controller/deletesong.php?id=".$playlistID."\">";
    for ($i=1; $i<=$num_row; $i++ ){
        $row = mysql_fetch_assoc($result);
        echo $row['songID']."         ".$row['name'];
        $songID = $row['songID'];
        echo "<input type='checkbox' name='songs[]' value='$songID'>";
        echo "</br>";
    }
    echo "<input type=\"submit\" value=\"Delete checked songs\">";
    echo "</form>";
    echo "<form method='post' action='songlist.php'>";
//    echo "<form method='get' action=\"addsong.php\">";
    echo "<input type=\"submit\" name='addsong' value=\"Add more songs\">";
    echo "</form>";
    echo "<form method='get' action=\"deleteplaylist.php\">";
    echo "<input type=\"submit\" value=\"Delete This Playlist\">";
    echo "</form>";
}
?>