<?php 
session_start();
include_once 'layout/header.php';
if (isset($_SESSION['user'])) {
	header("location: Users/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>

<body>
	<div class="container">
		<div class="container2">
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
	</div>
</body>
</html>
