<?php 
session_start();
$u = isset($_SESSION['user']) ? unserialize($_SESSION['user']) :'';

?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>
	<form method="POST" action="../../controller/checkedit.php" enctype="multipart/form-data">
		<label>name:</label></br>
		<input type="text" name="name" value="<?php if (isset($u->name)) {
				echo $u->name;  
			} ?>"></br>
		<label>dob:</label></br>
		<input type="date" name="dob" value="<?php if (isset($u->dob)) {
				echo $u->dob;  
			} else echo "1970-01-01"; ?>"></br>
		<label>address:</label></br>
		<input type="text" name="address" value="<?php if (isset($u->address)) {
				echo $u->address;  
			} ?>"></br>	
		<label>Gender:</label></br>
		<input type="radio" name="gender" value="female"> Female
  		<input type="radio" name="gender" value="male">  Male
  		<input type="radio" name="gender" value="notell"> Other
  		</br>
		<label>bio:</label></br>
		<input type="textfield" name="bio" value="<?php if (isset($u->name)) {
				echo $u->name;  
			} ?>"></br>
		<label>avatar:</label></br>
		<input type="file" name="fileToUpload" id="fileToUpload"></br>
		<input type="submit" value="Submit" name="submit">




<!--		<input type="submit" name="submit">-->
	</form>
</body>
</html>