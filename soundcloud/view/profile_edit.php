<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>
	<form method="POST" action="../../controller/checkedit.php">
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
		<label>avatar:</label></br>
		<input type="textfield" name="avatar"></br>




		<input type="submit" name="">
	</form>
</body>
</html>