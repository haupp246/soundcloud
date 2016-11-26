<?php
session_start();
include_once("../controller/db_connection.php");
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
    <?php include_once 'layout/header.php'; ?>
<!--    --><?php
//        echo "<br/><br/><br/>";
//        $db_connect=db_connect();
//        $id=$_GET['id'];
//        echo "<br/><br/><br/><br/>",$id;
//        $query="SELECT * FROM song WHERE songID='$id'";
//        $result=mysql_query($query,$db_connect) or die ("Error in $query");
//        $num_row=mysql_num_rows($result);
//
//    $row = mysql_fetch_array($result);
//    echo $row['userID']."   ".$row['name'];
//     ?>
<!--            <script>-->
<!--                /* Tiny HTML5 Music Player by Themistokle Benetatos */-->
<!--                TrackList =-->
<!--                    [-->
<!--                            --><?php
//
//                           // define("PATH_MEDIA_FILES", "../data/");
//                            $file = scandir ("../data/".$row['userID']."/");
//                            array_splice($file, 0, 2);
//                        echo  $row['userID']."/";
//                            $count = count($file);
//                          //  if ($num_row > 0) {
//                        echo PATH_MEDIA_FILES.$row['userID'].'/'.$row['name'];
//
//                        ?>
//                        {
//                            url: "<?php //echo "../data/".$row['userID'].'/'.$row['name']; ?>//",
//                            title:"<?php //echo $row['songID']." - ".$row['title'] ; ?>//",
//                            year:"<?php //echo !empty($row['artist']) 	? 	$row['artist'] 		: '';
//                                echo !empty($row['album'])	? " - ".$row['album'] 	: '';
//                                echo ($row['year'] != 0) 	? " - ".$row['year']	: ''; ?>//",
//
//                        }
//
//                    ];
//                <?php
//                        ?>
//                //Make a player and display help
//                //player([tracklist], [show waveform?], [show help?])
//                tinyplayer(TrackList, false,true);
//            </script>
    <?php
    $db_connect=db_connect();
    $query = "SELECT * FROM song WHERE userID = '$u->userID' ";
    $result = mysql_query($query,$db_connect)or die ("Error in query: $query");
    $num_row = mysql_num_rows($result);
    ?>
    <script>
    /* Tiny HTML5 Music Player by Themistokle Benetatos */
    TrackList =
        [
            <?php

            define("PATH_MEDIA_FILES", "../../data/");
            $file = scandir (PATH_MEDIA_FILES.$u->userID."/");
            array_splice($file, 0, 2);
            $count = count($file);
            if ($num_row > 0) {
            while ($row = mysql_fetch_array($result)) {

            ?>
            {
                url: "<?php echo PATH_MEDIA_FILES.$u->userID.'/'.$row['name'] ?>",
                title:"<?php echo $row['songID']." - ".$row['title'] ; ?>",
                year:"<?php echo !empty($row['artist']) 	? 	$row['artist'] 		: '';
                    echo !empty($row['album'])	? " - ".$row['album'] 	: '';
                    echo ($row['year'] != 0) 	? " - ".$row['year']	: ''; ?>",

            }
            <?php if ($row == $num_row)
        { echo "";}
        else {echo ",";}
            }
            } ?>
        ];

    //Make a player and display help
    //player([tracklist], [show waveform?], [show help?])
    tinyplayer(TrackList, false,true);
    </script>



</body>
</html>
    <?php
}


?>