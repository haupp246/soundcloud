<?php
include_once("../controller/db_connection.php");
session_start();

if(isset($_SESSION['user']))
{
    $u = unserialize($_SESSION['user']);
    
    $name = empty($u->name) ? $u->email : $u->name;
     

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
    <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
    <link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/list.css">
    <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
    <style type="text/css">
    	
    </style>
</head>
<body>
<?php include_once 'layout/header.php';?>
<div class="container">
	<h1>Advanced Search</h1>
	<form action="advanced_search_result.php" method="GET" accept-charset="utf-8">
		<p>Song name:<input type="text" name="name" placeholder="Name"></p>
		<p>Artist:<input type="text" name="artist" placeholder="Artist"></p>
		<p>Release Year:<input type="number" name="year" placeholder="Year"></p>
		<p>Album:<input type="text" name="album" placeholder="Album"></p>
		<p><input type="submit" ></p>
	</form>



</div>

</body>
</html>
<?php include_once 'layout/footer.php'; ?>
