<?php
session_start();
include_once("../../controller/db_connection.php");
date_default_timezone_get("Asia/Ho_Chi_Minh");
function time_elapsed_string($datetime, $full = false) {
   
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
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
    <style>
        #ava{
        /* position: absolute; */
        display: inline-flex;
        float: right;
        z-index: 2;
        }
        img.ava{
        height: 30px;
        width: 30px;
        border-radius: 100px;
        background-color: red;
        
        background-size: 100%;
        margin-right: 10px;
    }
    </style>
</head>
<body>
<?php include_once '../layout/header.php'; ?>
<div class="container container3">
<br/><br/><br/>
<?php

    $db_connect = db_connect();
    $query = "SELECT follow.time as ftime,actionID,userID,songID,playlistID,action.`time` FROM action inner join follow on userID=userID2 where userID1 = '$u->userID' ORDER BY actionID DESC";
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
                    $query2 = "SELECT user.name,user.avatar,song.title FROM user,song WHERE user.userID='$fl_id' and songID='$s_id'";
                    $result2 = mysql_query($query2,$db_connect)or die ("Error in query: $query2");
                    $row2 = mysql_fetch_array($result2);
                    $time =  date("H:i:s d-m-Y",strtotime($row['time']));
                ?>                  
                     <a style="text-decoration: none;" href="index.php?id=<?php echo $fl_id;?>" title="">
                        <img class="ava" src="../../assets/img/uploads/<?php echo $row2['avatar'];?>" height="100" />
                        <?php
                            echo $row2['name']."</a> has uploaded a song ".time_elapsed_string($time).":<br/>";
                        ?>
                     <a style="text-decoration: none;" href="../playsong.php?id=<?php echo $s_id;?>" title="">
                        <?php
                            echo $row2['title']."</a><br/><br/><br/><br/>";
                        
                }
                else 
                {
                    $fl_id=$row['userID'];
                    $p_id=$row['playlistID'];
                    $query2 = "SELECT user.name,user.avatar,playlist.name as title FROM user,playlist WHERE user.userID='$fl_id' and playlistID='$p_id'";
                    $result2 = mysql_query($query2,$db_connect)or die ("Error in query: $query2");
                    $row2 = mysql_fetch_array($result2);
                    $time =  date("H:i:s d-m-Y",strtotime($row['time']));
                ?>  
                    <a style="text-decoration: none;" href="index.php?id=<?php echo $fl_id;?>" title="">
                      <img class="ava" src="../../assets/img/uploads/<?php echo $row2['avatar'];?>" height="130" />  
                        <?php
                            echo $row2['name']."</a> has create a playlist ".time_elapsed_string($time).":<br/>";
                        ?>
                    <a style="text-decoration: none;" href="../playsong.php?id=<?php echo $s_id;?>" title="">
                        <?php
                            echo $row2['title']."</a><br/><br/><br/><br/>";
                }
            }
    }
    else 
        {
            echo "<p>You haven't followed any one.<br/></p>";
   
?>
     <a style="text-decoration: none;" href="suggest.php" title="">Try following someone</a>
</div>
<?php
}
db_closeconnect($db_connect);
}

?>

</body>
<body>
<div>
	<?php include_once '../layout/footer.php'; ?>
</div>
</body>
</html>
