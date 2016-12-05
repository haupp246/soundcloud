<?php 
session_start();
$u = isset($_SESSION['user']) ? unserialize($_SESSION['user']) :'';
if (!isset($_SESSION['user'])) {
	header("location: /soundcloud/view/login.php");
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
</head>
<body>
<?php include_once '../layout/header.php'; ?>
	<div class="container">
	<h1>Edit your profile</h1>
		<form method="POST" action="../../controller/checkedit.php" enctype="multipart/form-data">
		<div class="col span1"><h3>Full name:</h3></div>
		<div class="col span2"> <h3>
			<input style="width: 600px;" type="text" name="name" value="<?php if (isset($u->name)) {
				echo $u->name;  
				} ?>"> 

		</h3></div><br/>
		<div class="col span1"><h3>Birthday:</h3></div>
		<div class="col span2"><h3> 
			<input type="date" name="dob" value="<?php if(isset($u->dob)) {
				echo $u->dob;  
				} else echo "1970-01-01";?>">
		</h3></div><br/>
		<div class="col span1"><h3>Address:</h3></div>
		<div class="col span2"><h3> 
			<input style="width: 600px;" type="text" name="address" value="<?php if (isset($u->address)) {
				echo $u->address;  
			} ?>">
		</h3></div><br/>
		<div class="col span1"><h3>Gender:</h3></div>
		<div class="col span2"><h3> 
			<input type="radio" name="gender" <?php if($u->gender=='Female') echo "checked"; ?> value="Female"> Female
	  		<input type="radio" name="gender" <?php if($u->gender=='Male') echo "checked"; ?> value="Male">  Male
	  		<input type="radio" name="gender" <?php if($u->gender=='No-tell') echo "checked"; ?> value="No-tell"> Other
  		</h3></div><br/>
		<div class="col span1"><h3>Bio:</h3></div>
		<div class="col span2"><h3> 
			<textarea cols="50" rows="3" name="bio" ><?php if (isset($u->name)) {
				echo $u->name;  
                } ?></textarea>
            </h3></div><br/>
		<div class="col span1"><h3>Avatar:</h3></div>
		<div class="col span2"><h3>
			<input type="file"  name="fileToUpload" id="fileToUpload">
		</h3></div><br/><br/><br/><br/>
		<input type="submit" class="btn" value="Submit" name="submit">

	</form>
	</div>
</body>
</html>
<?php include_once '../layout/footer.php'; ?>