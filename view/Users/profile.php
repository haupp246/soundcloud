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
	<link rel="icon"  href="/soundcloud/assets/ico/1.png"/>
    <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
    <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
</head>
<body>
<?php include_once '../layout/header.php'; ?>
	<div class="container">
		<?php 
		echo "<h1>Hello ",$name,"</h1></br>";
		?>
		<div class="col span1"><h3>Address</h3></div>
		<div class="col span2"><h3><?php echo $u->address ?></h3></div><br/>
		<span><img id="ava" src="../../assets/img/uploads/<?php echo $link;?>" height="300" /></span>
		<div class="col span1"><h3>DOB</h3></div>
		<div class="col span2"><h3><?php echo $u->dob ?></h3></div><br/>

		<div class="col span1"><h3>Gender</h3></div>
		<div class="col span2"><h3><?php echo $u->gender ?></h3></div><br/>
		<div class="col span1"><h3>Bio</h3></div>
		<div class="col span2"><h3><?php echo $u->bio ?></h3></div><br/>
		<br/>
		<form method="POST" action="profile_edit.php">
		<br/>
		<br/>
			<input class="btn" type="submit" value="Edit your profile" name="edit">
		</form>

        <br/><br/>
        <a href="/soundcloud/view/Users/follower_list.php?id=<?php echo $u->userID;?>" title="">View followers list</a>
        <div id="all_tracks"></div>
	</div>

</body>
</html>
<?php } ?>
