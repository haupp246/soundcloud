<?php 
session_start();
if(isset($_SESSION['user']))
{
    $u = unserialize($_SESSION['user']);
    
    $name = empty($u->name) ? $u->email : $u->name;
?>
<!DOCTYPE html>
<html>
<head>
	<title>User index</title>

</head>
<body>
<?php include_once '../layout/header.php'; ?>
	<div class="container">
		<img id="ava" src="../../assets/img/uploads/<?php echo $link;?>" height="250" />
		<?php 
		echo "<h1>Hello ",$name,"</h1></br>";
		?>
		<div class="col span1"><h3>Address</h3></div>
		<div class="col span2"><h3><?php echo $u->address ?></h3></div>
		<div class="col span1"><h3>DOB</h3></div>
		<div class="col span2"><h3><?php echo $u->dob ?></h3></div>
		<div class="col span1"><h3>Gender</h3></div>
		<div class="col span2"><h3><?php echo $u->gender ?></h3></div>
		<div class="col span1"><h3>Bio</h3></div>
		<div class="col span2"><h3><?php echo $u->bio ?></h3></div>
		<br/>
		<form method="POST" action="profile_edit.php">
		<br/>
		<br/>
			<input class="btn" type="submit" value="Edit your profile" name="edit">
		</form>
	</div>
</body>
</html>
<?php } ?>