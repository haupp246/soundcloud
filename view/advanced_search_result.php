<?php
include_once("../controller/db_connection.php");
session_start();

if(isset($_SESSION['user']))
{
    $u = unserialize($_SESSION['user']);
    
    $name = empty($u->name) ? $u->email : $u->name;
    //$search= isset($_POST['searchBar']) ? $_POST['searchBar'] :''; 
}
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
<?php include_once 'layout/header.php';?>
<div class="container">
	<br/>
	<br/>
	Result:<br/>
	<table  cellspacing="10px">
	<?php
	$db_connect = db_connect();
	//$search= isset($_POST['searchBar']) ? $_POST['searchBar'] :''; 
	$songname=isset($_GET['name']) ? $_GET['name'] :'';
	$songname = strip_tags($songname);
	$artist=isset($_GET['artist']) ? $_GET['artist'] :'';
	$artist = strip_tags($artist);
	$year=isset($_GET['year']) ? $_GET['year'] :'';
	$year = strip_tags($year);
	$album=isset($_GET['album']) ? $_GET['album'] :'';
	$album = strip_tags($album);
	
	$query = "SELECT DISTINCT * 
				FROM song 	
				WHERE name LIKE '%$songname%' 
				and artist LIKE '%$artist%'
				and year = '$year'
				and album LIKE '%$album%'
				ORDER BY name ASC";
	$result = mysql_query($query,$db_connect)or die("Error in query $query");
	$num_row = mysql_num_rows($result);
	$count=0;
	if ($num_row >0)
	{	echo $num_row." found:<br/><br/>";
   		while ($row = mysql_fetch_assoc($result)) {
	?>
		<!-- <tr  <?php if($count%2==0) echo "class=\"prpr\""; ?> > -->
			<!-- <td rowspan="2"><img class="listava" src="../../assets/img/uploads/<?php echo $row['avatar'];?>" height="130" /></td> -->
			
				
				<a href="/soundcloud/view/playsong.php?id=<?php echo $row['songID'];?>" title=""><?php echo $row["name"]; ?></a> 
				<br/>
				<?php 
					//echo "Name: ".$row['name']."<br/>";
					echo "Title: ".$row['title']."<br/>";
					echo "Artist: ".$row['artist']."<br/>";
					echo "Album: ".$row['album']."<br/>";
					echo "Release Year:".$row['year']."</br>";				
				?>
			
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
			echo "<br/>Sorry no result found<br/>";
		}
	?>
	

	<?php
		db_closeconnect($db_connect);

	?>
</table>


</div>

</body>
</html>
