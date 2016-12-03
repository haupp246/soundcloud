<?php
session_start();
include_once("../../controller/db_connection.php");
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
<?php include_once '../layout/header.php'; ?>
<div class="container container3">
<br/><br/><br/>
<?php
    $db_connect = db_connect();
    $query = "SELECT * FROM `action` inner join follow on userID=userID2 where userID1 = '$u->userID' ORDER BY actionID DESC";
    $result = mysql_query($query,$db_connect)or die ("Error in query: $query");
    $num_row = mysql_num_rows($result);
    
    if ($num_row > 0) 
    {
            while ($row = mysql_fetch_array($result)) 
            {
                if ($row['songID']>0)
                {   
                    $fl_id=$row['userID'];
                    $s_id=$row['songID'];
                    $query2 = "SELECT user.name,song.title FROM user,song WHERE user.userID='$fl_id' and songID='$s_id'";
                    $result2 = mysql_query($query2,$db_connect)or die ("Error in query: $query2");
                    $row2 = mysql_fetch_array($result2);
?>
                     <a style="text-decoration: none;" href="index.php?id=<?php echo $fl_id;?>" title="">
                        <?php
                            echo $row2['name']."</a> has uploaded a song:<br/>";
                        ?>
                     <a style="text-decoration: none;" href="../playsong.php?id=<?php echo $s_id;?>" title="">
                        <?php
                            echo $row2['title']."</a><br/><br/>";
                        
                }
                else 
                {
                    $fl_id=$row['userID'];
                    $p_id=$row['playlistID'];
                    $query2 = "SELECT user.name,playlist.name as title FROM user,playlist WHERE user.userID='$fl_id' and playlistID='$p_id'";
                    $result2 = mysql_query($query2,$db_connect)or die ("Error in query: $query2");
                    $row2 = mysql_fetch_array($result2);
                ?>  
                    <a style="text-decoration: none;" href="index.php?id=<?php echo $fl_id;?>" title="">
                        <?php
                            echo $row2['name']."</a> has create a playlist:<br/>";
                        ?>
                    <a style="text-decoration: none;" href="../playsong.php?id=<?php echo $s_id;?>" title="">
                        <?php
                            echo $row2['title']."</a><br/><br/>";
                }
            }
    }
    else echo "Deo co gi hay ca";
?>
</div>
</body>

</html>
<?php 
db_closeconnect($db_connect); 
 


}
include_once '../layout/footer.php'; 
//db_closeconnect($db_connect); 
?>
