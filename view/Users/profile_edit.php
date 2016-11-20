<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>
	<form method="POST" action="../../controller/checkedit.php" enctype="multipart/form-data">
		<label>*name:</label></br>
		<input required type="text" name="name"></br>
		<label>dob:</label></br>
		<input type="date" name="dob"></br>
		<label>address:</label></br>
		<input type="text" name="address"></br>	
		<label>Gender:</label></br>
		<input type="radio" name="gender" value="female"> Female
  		<input type="radio" name="gender" value="male">  Male
  		<input type="radio" name="gender" value="notell"> Other
  		</br>
		<label>bio:</label></br>
		<input type="textfield" name="bio"></br>
		Avatar:</br>
		<input type="file" name="fileToUpload" id="fileToUpload"></br>
		<input type="submit" value="Submit" name="submit">




<!--		<input type="submit" name="submit">-->
	</form>
</body>
</html>