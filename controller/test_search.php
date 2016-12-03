<?php
	include_once("db_connection.php");
	$db_connect = db_connect();
	//$search= isset($_POST['searchBar']) ? $_POST['searchBar'] :''; 
	$search=isset($_POST['keyword']) ? $_POST['keyword'] : '';
	$query = "SELECT DISTINCT * FROM song WHERE name LIKE '%$search%' ORDER BY name ASC LIMIT 5";
	$result = mysql_query($query,$db_connect)or die("Error in query $query");
	$num_row = mysql_num_rows($result);
	if ($num_row>0)
	echo "<li>Song:</li>"; 
	while ($row=mysql_fetch_array($result))
	{
		echo "<li><a style='color:blue;' href='/soundcloud/view/playsong.php?id=".$row['songID']."' title=''>".$row['name']."</a></li>";
	}
	$query = "SELECT DISTINCT * FROM playlist WHERE name LIKE '%$search%' ORDER BY name ASC LIMIT 5";
	$result = mysql_query($query,$db_connect)or die("Error in query $query");
	$num_row = mysql_num_rows($result);
	if ($num_row>0)
	echo "<li>Playlist:</li>";
	while ($row=mysql_fetch_array($result))
	{
		echo "<li><a style='color:blue;' href='/soundcloud/view/playlist.php?id=".$row['playlistID']."' title=''>".$row['name']."</a></li>";
	}
	$query ="SELECT * FROM user WHERE name LIKE '%$search%' LIMIT 5";
	$result = mysql_query($query,$db_connect)or die("Error in query $query");
	$num_row= mysql_num_rows($result);
	if ($num_row>0)
	echo "<li>User:</li>";
	while ($row=mysql_fetch_array($result))
	{
		echo "<li><a style='color:blue;' href='/soundcloud/view/Users/view_profile.php?id=".$row['userID']."' title=''>".$row['name']."</a></li>";
	}
echo "<li><a style='background-color: #EAEAEA;padding-left: 0px;margin-left: 0px;border: 0px;' href='/soundcloud/view/search.php?search=".$search."' title=''><span style='margin:auto;'>See all the result</span></span></a></li>";
?>