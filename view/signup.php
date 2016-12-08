<?php 
session_start();
include_once 'layout/header.php';
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
	<style type="text/css" media="screen">
			.btnn[value='Join us now !']{
				visibility: hidden;
			}
			.social>li>a{
				margin-top: 9px;
			}
	</style>	
</head>

<body>
	<div class="container">
		<div >
			<h1>Signup</h1>
			<form method="POST" action="../controller/checksignup.php">
				<label><h3>Email: </h3></label>
				<br/>
				<input type="email" name="email" required="required" placeholder="abcd1234@zxy.abc">
				<br/>	<br/>
				<label><h3>Name: </h3></label>
				<br/>
				<input type="text" name="name" required="required" placeholder="Nguyễn Văn A">
				<br/>	<br/>
				<label><h3>Password</h3></label>
				<br/>
				<input type="password" name="pass" required="required" placeholder="******">
				<br/>
				<br/>
				<label><h3>Re-type Password</h3></label>
				<br/>
				<input type="password" name="pass2" required="required" placeholder="******">
				<br/>
				<br/><br/><br/>
				<input type="submit" class="btn" name="submit" value="Sign up">
			</form>
		</div>
	</div>
</body>
</html>
