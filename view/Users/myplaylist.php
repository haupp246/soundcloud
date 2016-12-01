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
    <meta name="author" content="ThaiVH" />
    <meta name="description" content="soundcloud"/>
    <meta name="keyword" content="sound, cloud, music"/>
    <meta charset="utf-8"/>
    <link rel="icon"  href="/soundcloud/assets/ico/1.ico"/>
    <link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/custom2.css">
    <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
    <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
</head>

<body>


<?php
$db_connect = db_connect();
//$query = "INSERT INTO playlist (name, userID) VALUES ('$pname','$u->userID')";
//$result = mysql_query($query,$db_connect)or die("Error in query $query");
$query = "SELECT * FROM playlist WHERE userID = '$u->userID'";
$result = mysql_query($query,$db_connect)or die("Error in query $query");
$num_row = mysql_num_rows($result);
//echo "<form method='get' action=\"/soundcloud/controller/editplaylist.php\">";
for ($i=1; $i<=$num_row; $i++ ){
    $row = mysql_fetch_assoc($result);
    $id  = $row['playlistID'];
?>
        <a href="/soundcloud/view/playlist.php?id=<?php echo $row['playlistID']; ?>" title=""><?php echo $row["name"]; ?></a> 
<?php
    echo"<a href=\"/soundcloud/controller/edit_playlist.php?id=".$id."\">"."edit</a>";
    echo "</br>";
}
echo "</form>";
?>
<form method="post" action="/soundcloud/view/Users/songlist.php">
    <input type="text" name="pname" placeholder="Playlist Name">
    <input type="submit" name="add" value="Create Playlist"  >
</form>
</body>
</html>
<?php } db_closeconnect($db_connect); ?>