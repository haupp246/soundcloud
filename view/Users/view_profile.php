<?php
session_start();
include("../../controller/db_connection.php");
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
    <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
</head>
<body>
<?php include_once '../layout/header.php'; ?>
	<div class="container">
		<?php 
		$db_connect = db_connect();
		$id= isset($_GET['id']) ? $_GET['id'] : '';
		$query="SELECT * FROM user WHERE userID = '$id'";
		$result=mysql_query($query,$db_connect) or die ("Error in query: $query");
		$num_row=mysql_num_rows($result);
		if ($num_row==1)
		{
			 $p = mysql_fetch_object($result);
		
		echo "<h1>",$p->name,"'s profile</h1></br>";
		?>
		<div class="col span1"><h3>Address</h3></div>
		<div class="col span2"><h3><?php echo $p->address ?></h3></div><br/>
		<span><img id="ava" src="../../assets/img/uploads/<?php echo $p->avatar;?>" height="300" /></span>
		<div class="col span1"><h3>DOB</h3></div>
		<div class="col span2"><h3><?php echo $p->dob ?></h3></div><br/>

		<div class="col span1"><h3>Gender</h3></div>
		<div class="col span2"><h3><?php echo $p->gender ?></h3></div><br/>
		<div class="col span1"><h3>Bio</h3></div>
		<div class="col span2"><h3><?php echo $p->bio ?></h3></div><br/>
		<br/>
		<?php
		$query="SELECT * FROM follow WHERE userID1='$u->userID' and userID2='$p->userID'";
		$result=mysql_query($query,$db_connect) or die ("Error in query: $query");
		?>
		<form method="POST" action="">
		<br/>
		<br/>
			<input class="btn" type="submit" value="Follow this user" name="follow">
		</form>

        

        <br><br>

        <div id="all_tracks"></div>
	</div>
</body>
</html>
<?php 
}
} ?>
<?php include_once '../layout/footer.php'; ?>