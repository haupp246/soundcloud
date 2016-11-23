<?php
include_once("db_connection.php");
session_start();

if(isset($_SESSION['user']))
{
    if (isset($_POST['submit'])) {
        $title = isset($_POST['title']) ? $_POST['title'] : '' ;
        $title = mysql_real_escape_string($title);
        $artist = isset($_POST['artist']) ?  $_POST['artist'] : '' ;
        $artist = mysql_real_escape_string($artist);
        $year = isset($_POST['year']) ?  $_POST['year'] : 0 ;
        $album = isset($_POST['album']) ? $_POST['album'] : '' ;
        $album = mysql_real_escape_string($album);
        $genre = isset($_POST['genre']) ? $_POST['genre'] : '' ;
        $genre = mysql_real_escape_string($genre);
        $name = $_POST['name'];
        $name = mysql_real_escape_string($name);
        $db_connect = db_connect();
        $query = "UPDATE song SET title='$title',artist='$artist',year=$year,genre='$genre',album='$album' WHERE name = '$name'";
        $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
        db_closeconnect($db_connect);  
        header("location: /soundcloud/view/Users/index.php");
    }
}
?>