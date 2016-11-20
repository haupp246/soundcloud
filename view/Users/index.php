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
	$name = empty($u->name) ? $u->email : $u->name;
	echo "Hello ",$name,"</br>";
	echo "Address: ",$u->address,"</br>";
	echo "DOB: ",$u->dob,"</br>";
	echo "Gender: ",$u->gender,"</br>";
	echo "Bio: ",$u->bio,"</br>";
	?>
	Avatar:
	<?php 
	$link="../../controller/".$u->avatar;
	echo $link;
	?>
	<img src=<?php echo $link;?>/>
	<form method="POST" action="profile_edit.php">

		<input type="submit" value="Edit" name="edit">
	</form>
</body>
</html>