<?php
include_once("../../controller/db_connection.php");
session_start();
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
    <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
    <link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/list.css">
    <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
    <style type="text/css">
    	
    </style>
</head>
<body>
<?php include_once '../layout/header.php';?>
<div class="container">
	<h1>User List</h1>
	<table>
	<?php
	$db_connect = db_connect();
	$query = "SELECT DISTINCT * FROM user ORDER BY name ASC ";
	$result = mysql_query($query,$db_connect)or die("Error in query $query");
	$num_row = mysql_num_rows($result);

	if ($num_row >0)
	{	
   		while ($row = mysql_fetch_assoc($result)) {
		//echo $row["userID"]," ",$row["name"],"<br/>";
		
	?>
	<tr class="prpr">
		<td><img class="listava" src="../../assets/img/uploads/<?php echo $link;?>" height="130" /></td>
		<td class="listpr">
			<a class="list" href="/soundcloud/view/Users/profile.php?id=<?php echo $row['userID'];?>" title=""><?php echo $row["name"]; ?></a>
		</td>
	</tr>
	<table>
		
	</table>
	<?php
	}
	}
		   db_closeconnect($db_connect);
	}
	?>



</div>

</body>
</html>