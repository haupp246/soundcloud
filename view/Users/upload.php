<?php 
session_start();
$u = isset($_SESSION['user']) ? unserialize($_SESSION['user']) :'';
if (!isset($_SESSION['user'])) {
	header("location: /soundcloud/view/login.php");
}
include_once '../layout/header.php';
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
</head>
<body>
	<div class="container">
		<h1>Upload</h1>
		<form method="POST" action="../../controller/checkupload.php" enctype="multipart/form-data">
			<div class="col span1"><h3>title:</h3></div>
			<div class="col span2"><h3>
				<input type="text" name="title"> 
			</h3></div>
			<br/>
			<div class="col span1"><h3>File:</h3></div>
			<div class="col span2"><h3>
				<input type="file"  name="fileToUpload" id="fileToUpload">
			</h3></div>
			<br/>
			<input type="submit" class="btn" value="Submit" name="submit">
		</form>
	</div>
</body>
</html>