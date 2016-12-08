<?php
session_start();
include_once("db_connection.php");
include_once ("../view/layout/header.php");
echo "</br></br></br></br>";
if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
}
if(isset($_SESSION['user'])) $u = unserialize($_SESSION['user']);
include_once("db_connection.php");
$db_connect = db_connect();
$playlistID = $_SESSION['playlistID'];
$query = "SELECT name FROM playlist WHERE playlistID='$playlistID'";
$result =  mysql_query($query,$db_connect) or die ("Error $query");
$row = mysql_fetch_assoc($result);
echo "<form method='post' action=''>";
echo "<input type='text' name='newname' required value= $row[name]>";
echo "<input type='submit' name='submit' value='Change'>";
echo "</form>";
if (isset($_POST['submit']) ) {
    $name = $_POST['newname'];
//    echo $name;
    $query = "UPDATE playlist SET name = '$name' WHERE playlistID='$playlistID'";
    $result = mysql_query($query, $db_connect) or die ("Error $query");
    echo "</br></br></br></br>";
    echo "
                <script language=\"javascript\">
                    alert(\"Success\");
                </script>
                <script> window.location = \"/soundcloud/view/Users/index.php\"; </script>";
 
}

?>