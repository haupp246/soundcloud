<?php 
session_start();
if(isset($_SESSION['user']))
{
    $u = unserialize($_SESSION['user']);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>User index</title>
</head>
<body>
	<?php 
	echo "Hello ",$u->name,"</br>";
	echo "Address: ",$u->address,"</br>";
	echo "DOB: ",$u->dob,"</br>";
	echo "Gender: ",$u->gender,"</br>";
	echo "Bio: ",$u->bio,"</br>";
	echo "Avatar: ",$u->avatar,"</br>";
	 ?>
	<form method="POST" action="profile_edit.php">

		<input type="submit" value="Edit" name="edit">
	</form>
</body>
</html>