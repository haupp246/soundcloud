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
    $id = isset($_GET['id']) ? $_GET['id'] : '';
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
	<br/>
	<table  cellspacing="10px">
	<?php
	$db_connect = db_connect();
	$query ="SELECT * FROM user WHERE userID = $id";
	$result = mysql_query($query,$db_connect)or die("Error in query $query");
	$num_row= mysql_num_rows($result);
	if ($num_row>0)
	{	$row = mysql_fetch_assoc($result);
		$name2 = empty($row['name']) ? $row['email'] : $row['name'];
		echo "<h1>".$name2."'s followers list</h1>";
		$query = "SELECT * FROM user INNER JOIN follow ON user.userID=follow.userID1 WHERE userID2= $id ORDER BY name ASC";
		$result = mysql_query($query,$db_connect)or die("Error in query $query");
		$num_row = mysql_num_rows($result);
		$count=0;
		if ($num_row >0)
		{	
	   		while ($row = mysql_fetch_assoc($result)) 
	   		{
		?>
			<tr  <?php if($count%2==0) echo "class=\"prpr\""; ?> >
				<td rowspan="2"><img class="listava" src="../../assets/img/uploads/<?php echo $row['avatar'];?>" height="130" /></td>
				<td class="listpr">
					<a class="list" href="/soundcloud/view/Users/view_profile.php?id=<?php echo $row['userID'];?>" title=""><?php echo $row["name"]; ?></a>
				</td>
			</tr>
			<tr <?php if($count%2==0) echo "class=\"prpr\""; $count++ ?> >
				<td>
					<span class="list2"><?php echo $row['followercount']; ?> follower(s)</span>
				</td>
			</tr>
		
		<?php
			}
		}
		else echo "<h2>No follower :sadface:</h2>";
	}
	else echo "<h1>Sorry this user doesn't exist</h1>";
		db_closeconnect($db_connect);
}
	?>
</table>


</div>

</body>
</html>
<?php include_once '../layout/footer.php'; ?>