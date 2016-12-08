<?php
if (session_status() === PHP_SESSION_NONE){session_start();}
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
        <link rel="icon"  href="/soundcloud/assets/ico/1.png"/>
        <link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/custom2.css">
        <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
        <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
    </head>

    <body>


    <?php
    $db_connect = db_connect();
    $userID = $_GET['id'];
    $query = "SELECT * FROM playlist WHERE userID = '$userID'";
    $result = mysql_query($query,$db_connect)or die("Error in query $query");
    $num_row = mysql_num_rows($result);
    if ($num_row == 0) echo ("This user don't have any playlist :(");
    while($row = mysql_fetch_array($result)){
        $id  = $row['playlistID'];
        ?>
        <a href="/soundcloud/view/playlist.php?id=<?php echo $row['playlistID']; ?>" title=""><?php echo $row['playlistID'].$row["name"]; ?></a>

        <?php
//        echo"<a href=\"/soundcloud/controller/edit_playlist.php?id=".$id."\"></a>";
//        echo "</br>";

        $query2 = "SELECT song.name, song.songID FROM song 
              INNER JOIN songinplaylist ON song.songID = songinplaylist.songID 
              WHERE playlistID = '$id'";
        $result2 = mysql_query($query2,$db_connect)or die("Error in query $query2");
        while ($row2 = mysql_fetch_assoc($result2)) {
            ?>
            <a style="color: #ff7430" href="/soundcloud/view/playsong.php?id=<?php echo $row2['songID'];?>" title=""><?php echo $row2["name"]; ?></a>
            <?php
            echo "</br>";
        }
        echo "</br></br>";
    }
    echo "</form>";
    ?>

    </body>
    </html>
    <?php
    echo "</br></br></br></br>";
    include_once ("../layout/footer.php");
} db_closeconnect($db_connect); ?>

