<?php
session_start();
include_once("../../controller/db_connection.php");
include_once ("../layout/header.php");
echo "<br/><br/><br/><br/><br/>";
if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
}
if(isset($_SESSION['user']))
{
$u = unserialize($_SESSION['user']);

$name = empty($u->name) ? $u->email : $u->name;
?>
<!DOCTYPE html>
<html>
<head>
    <title>HTTV music – Music makes me</title>
    <meta name="author" content="ThaiVH"/>
    <meta name="description" content="soundcloud"/>
    <meta name="keyword" content="sound, cloud, music"/>
    <meta charset="utf-8"/>
    <link rel="icon" href="/soundcloud/assets/ico/1.ico"/>
    <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
    <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
</head>
<body>


<?php

$pname = isset($_POST['pname']) ? $_POST['pname'] : '';
//$time = date('d-m-Y H:i:s');

$db_connect = db_connect();
if (isset($_POST['pname'])) {
    $query = "INSERT INTO playlist (name, userID, createTime) VALUES ('$pname','$u->userID', now())";
    $result = mysql_query($query, $db_connect) or die("Error in query $query");
    $query = "SELECT * FROM song";
    $result = mysql_query($query, $db_connect) or die("Error in query $query");
    $num_row = mysql_num_rows($result);
    echo "<form method='post' action='../../controller/create_playlist.php'>";
    for ($i = 1; $i <= $num_row; $i++) {
        $row = mysql_fetch_assoc($result);
        $id = $row['songID'];
        echo $row['songID'] . $row['name'];

        echo "<input type='checkbox' name='songs[]' value='$id'>";
        echo "</br>";
    }
    echo "<input type=\"submit\" value=\"Add to playlist\">";
    echo "</form>";
//$query = "INSERT "
//if ($num_row >0)
//{
//    while ($row = mysql_fetch_assoc($result)) {
//        //echo $row["userID"]," ",$row["name"],"<br/>";
//        echo "<a href='/soundcloud/view/Users/profile.php?id=".$row['userID']."'>".$row["name"]."</a><br/>";
//    }
//}
    db_closeconnect($db_connect);

}

else if (isset($_POST['addsong']) && isset($_SESSION['playlistID'])) {
    $playlistID = $_SESSION['playlistID'];
    $query = "SELECT * FROM song";
    $result = mysql_query($query, $db_connect) or die("Error in query $query");
    $num_row = mysql_num_rows($result);
    echo "<form method='post' action='../../controller/addsong.php?id=".$playlistID."'>";
    for ($i = 1; $i <= $num_row; $i++) {
        $row = mysql_fetch_assoc($result);
        $id = $row['songID'];
        echo $row['songID'] . $row['name'];
        echo "<input type='checkbox' name='songs[]' value='$id'>";
        echo "</br>";
    }
    echo "<input type=\"submit\" value=\"Add to playlist\">";
    echo "</form>";
//$query = "INSERT "
//if ($num_row >0)
//{
//    while ($row = mysql_fetch_assoc($result)) {
//        //echo $row["userID"]," ",$row["name"],"<br/>";
//        echo "<a href='/soundcloud/view/Users/profile.php?id=".$row['userID']."'>".$row["name"]."</a><br/>";
//    }
//}
    db_closeconnect($db_connect);
}
}
?>
