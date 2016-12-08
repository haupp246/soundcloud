<?php
include_once("../controller/db_connection.php");
session_start();

if(isset($_SESSION['user']))
{
    $u = unserialize($_SESSION['user']);
    
    $name = empty($u->name) ? $u->email : $u->name;
}
    $search= isset($_GET['search']) ? $_GET['search'] :''; 
    $search = strip_tags($search);
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
    <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
    <link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/list.css">
    <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
    <style type="text/css">
    	
    </style>
</head>
<body>
<?php
include_once 'layout/header.php';
$db_connect = db_connect();
?>
<div class="container">
	<h2>Your keyword: <?php echo $search;?></h2>
	<br/>
    <ul class="nav nav-tabs tabs-select">
        <li class="active"><a data-toggle="tab" href="#tracks">Tracks</a></li>
        <li><a data-toggle="tab" href="#playlists">Playlists</a></li>
        <li><a data-toggle="tab" href="#user">User</a></li>
    </ul>

    <div class="tab-content">
        <div id="tracks" class="tab-pane fade in active">
			<?php
			$query = "SELECT DISTINCT * FROM song WHERE title LIKE '%$search%' ORDER BY title ASC";
			$result = mysql_query($query,$db_connect)or die("Error in query $query");
			$num_row = mysql_num_rows($result);
			$count=0;

			if ($num_row > 0 )
			{
			    echo "<h1 align='left'>Song:";
			    echo $num_row." found.</h1>";
				while ($row = mysql_fetch_assoc($result)) {
			    $image = isset($row['image'])? $row['image'] :"default.png";
					?>
                    <div class="col-md-2" style="clear: left;margin-bottom: 20px">
                        <img width="100%" src="/soundcloud/assets/img/song/<?php echo $image; ?>">
                    </div>
                    <div class="col-md-10" style="clear: right;margin-bottom: 20px">
                        <a style="text-decoration: none;color: #2aabd2;" href="/soundcloud/view/playsong.php?id=<?php echo $row['songID'];?>" title=""><h2><?php echo $row["title"]; ?></h2></a>
					<?php
					echo "<span style=\"margin-right: 5px;\" class=\"glyphicon glyphicon-play\" aria-hidden=\"true\" title=\"".$row['viewCount']." times played\">"."</span>".$row['viewCount'];
                    echo "<span style=\"margin-right: 5px;margin-left: 10px;\" class=\"glyphicon glyphicon-heart\" aria-hidden=\"true\" title=\"".$row['likeCount']." likes\"></span>".$row['likeCount']."<br/>";
					echo isset($row['artist']) ? "Artist: ".$row['artist']."<br/>" : '';
					echo isset($row['album']) ? "Album: ".$row['album']."<br/>" : '';
					echo (isset($row['year']) AND $row['year']!= 0 ) ? "Release Year:".$row['year']."</br>" : '';
					echo "</div>";
				}
			}
			else
			{
				echo "<h2>Sorry no result found</h2>";
			}
			?>
            <div class="col-md-12" style="margin-top: 20px;"><a class="btn btn-primary" href="/soundcloud/view/advanced_search.php"><h3 style="margin: 10px;"> Advanced search </h3></a></div>
        </div>
        <div id="playlists" class="tab-pane fade">
	        <?php
	        $query = "SELECT DISTINCT * FROM playlist WHERE name LIKE '%$search%' ORDER BY name ASC";
	        $result = mysql_query($query,$db_connect)or die("Error in query $query");
	        $num_row = mysql_num_rows($result);
	        $count=0;
	        echo "Playlist:";
	        if ($num_row >0)
	        {	echo $num_row." found.<br/>";
		        while ($row = mysql_fetch_assoc($result)) {
			        ?>
                    <!-- <tr  <?php if($count%2==0) echo "class=\"prpr\""; ?> > -->
                    <!-- <td rowspan="2"><img class="listava" src="../../assets/img/uploads/<?php echo $row['avatar'];?>" height="130" /></td> -->


                    <a href="/soundcloud/view/playlist.php?id=<?php echo $row['playlistID']; ?>" title=""><?php echo $row["name"]; ?></a>
                    <br/>


                    <!-- </tr> -->
                    <!-- 		<tr <?php if($count%2==0) echo "class=\"prpr\""; $count++ ?> >
			<td>
				<span class="list2"><?php echo $row['followercount']; ?> follower(s)</span>
			</td>
		</tr> -->

			        <?php
		        }
	        }
	        else
	        {
		        echo "<br/><br/><br/>Sorry no result found";
	        }
	        ?>
            <br/><br/><br/>
        </div>
        <div id="user" class="tab-pane fade">

	        <?php
	        $query ="SELECT * FROM user WHERE name LIKE '%$search%'";
	        $result = mysql_query($query,$db_connect)or die("Error in query $query");
	        $num_row= mysql_num_rows($result);

	        if ($num_row >0)
	        {	echo "<h1>User:".$num_row." found.</h1>";
		        while ($row = mysql_fetch_assoc($result))
		        {
			        ?>
                    <div class="col-md-2" style="clear: left;margin-bottom: 20px">
                        <img class="listava" src="../assets/img/uploads/<?php echo $row['avatar'];?>" width="100%" />
                    </div>
                    <div class="col-md-10" style="clear: right;margin-bottom: 20px" align="left">
                            <a style="text-decoration: none;color: #2aabd2;" class="list" href="/soundcloud/view/Users/index.php?id=<?php echo $row['userID'];?>" title=""><?php echo $row["name"]; ?></a>
                            <span style="margin-left: 50px;" ><?php echo ($row['followercount']>1)? $row['followercount']." followers" : $row['followercount']." follower"; ?><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                    </div>


			        <?php
		        }
	        }
	        else echo "<h2>Sorry no result found</h2>";

	        ?>
        </div>
    </div>








</div>

</body>
</html>
<?php
db_closeconnect($db_connect);

?>
