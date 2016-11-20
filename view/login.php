<?php 
include_once 'layout/header2.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<style type="text/css" media="screen">
	input[type="button"]{
		visibility: hidden;
	}
	.container2{
		padding-top: 100px;
		width: 400px;
		height: 600px;
	}
	input[name="pass"],input[name="email"]{
		width: 400px;
		height: 40px;
		border-radius: 5px;
		padding-left: 10px;
		font-size: 1.1em; 
	}
	h1{
		display: block;
		margin: auto;
		text-align: center;
	}
</style>
<body>
	<div class="container container2">
		<h1>Login</h1>
		<br/>
		<br/>
		<form method="POST" action="../controller/checklogin.php">
			<label><h3>Email: </h3></label>
			<br/>
			<input type="text" name="email" placeholder="abcd1234@zxy.abc">
			<br/>	<br/>
			<label><h3>Password</h3></label>
			<br/>
			<input type="password" name="pass" placeholder="******">
			<br/>
			<br/>
			<input type="submit" class="btn" name="submit" value="Login">
		</form>
	</div>
</body>
</html>