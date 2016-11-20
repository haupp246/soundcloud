<?php 
session_start();
include_once 'layout/header.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>

<body>
	<div class="container">
		<div >
			<h1>Signup</h1>

			<form method="POST" action="../controller/checksignup.php">
				<label><h3>Email: </h3></label>
				<br/>
				<input type="text" name="email" placeholder="abcd1234@zxy.abc">
				<br/>	<br/>
				<label><h3>Name: </h3></label>
				<br/>
				<input type="text" name="name" placeholder="Nguyễn Văn A">
				<br/>	<br/>
				<label><h3>Password</h3></label>
				<br/>
				<input type="password" name="pass" placeholder="******">
				<br/>
				<br/>
				<label><h3>Re-type Password</h3></label>
				<br/>
				<input type="password" name="pass2" placeholder="******">
				<br/>
				<br/><br/><br/>
				<input type="submit" class="btn" name="submit" value="Sign up">
			</form>
		</div>
	</div>
</body>
</html>
