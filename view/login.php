<?php 
session_start();

if (isset($_SESSION['user'])) {
	header("location: Users/profile.php");
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
	<link rel="icon"  href="/soundcloud/assets/ico/1.ico"/>		
	<style type="text/css">
		.btnn[value='Sign In']{
				visibility: hidden;
			}
		.social>li>a{
			margin-top: 9px;
		}
	</style>	
</head>

<body>
<?php include_once 'layout/header.php'; ?>
	<div class="container">
		<div class="container2">
			<h1>Login</h1>
			<form method="POST" action="../controller/checklogin.php">
				<label><h3>Email: </h3></label>
				<br/>
				<input type="text" name="email" required="required" placeholder="abcd1234@zxy.abc">
				<br/>	<br/>
				<label><h3>Password</h3></label>
				<br/>
				<input type="password" name="pass" required="required" placeholder="******">
				<br/>
				<br/>
				<input type="submit" class="btn" required="required" name="submit" value="Login">
			</form>
		</div>
	</div>
</body>
</html>
<?php include_once 'layout/footer.php'; ?>