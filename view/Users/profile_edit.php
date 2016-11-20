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
	<title>login</title>
</head>
<body>
<?php include_once '../layout/header.php'; ?>
	<div class="container">
		<form method="POST" action="../../controller/checkedit.php" enctype="multipart/form-data">
		<div class="col span1"><h3>Full name:</h3></div>
		<div class="col span2"> <h3>
			<input type="text" name="name" value="<?php if (isset($u->name)) {
				echo $u->name;  
				} ?>"> 

		</h3></div>
		<div class="col span1"><h3>Birthday:</h3></div>
		<div class="col span2"><h3> 
			<input type="date" name="dob" value="<?php if (isset($u->dob)) {
				echo $u->dob;  
				} else echo "1970-01-01"; ?>">
		</h3></div>
		<div class="col span1"><h3>Address:</h3></div>
		<div class="col span2"><h3> 
			<input type="text" name="address" value="<?php if (isset($u->address)) {
				echo $u->address;  
			} ?>">
		</h3></div>
		<div class="col span1"><h3>Gender:</h3></div>
		<div class="col span2"><h3> 
			<input type="radio" name="gender" value="female"> Female
	  		<input type="radio" name="gender" value="male">  Male
	  		<input type="radio" name="gender" value="notell"> Other
  		</h3></div>
		<div class="col span1"><h3>Bio:</h3></div>
		<div class="col span2"><h3> 
			<input type="textfield" name="bio" value="<?php if (isset($u->name)) {
				echo $u->name;  
				} ?>">
			</h3></div>
		<div class="col span1"><h3>Avatar:</h3></div>
		<div class="col span2"><h3>
			<input type="file"  name="fileToUpload" id="fileToUpload">
		</h3></div>
		<input type="submit" class="btn" value="Submit" name="submit">

	</form>
	</div>
</body>
</html>