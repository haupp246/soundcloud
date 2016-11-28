<?php
	session_start();
	if (isset($_SESSION['user'])) header("location: view/Users/index.php ");
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
		<link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/bootstrap.css"/>							
		<style type="text/css" media="screen">
			@import "/soundcloud/assets/css/custom.css";
			html{

			}
		</style>						
		<script src="assets/js/jquery-3.1.1.js" type="text/javascript"> </script>				
		<script type="text/javascript">
			// code js
		</script>
		<noscript>Trình duyệt không hỗ trợ js</noscript>
	</head>	
	<body>
		<nav class="navbar">
			<div class="container nav">
				<a href="#">
				<img src="/soundcloud/assets/img/logo.png" height="70px" alt="" title="">
				<h2>HTTV music</h2></a>
				<a href="/soundcloud/view/signup.php"><input type="button" class="btn" value="Join us now !"></a>
				<a href="/soundcloud/view/login.php"><input type="button" class="btn" value="Sign In"></a>
			</div>
		</nav>
		<div class="container index">
			<a href="">
			<h1>HTTV music - Find the music you love
			</h1></a>
			
		</div>
	</body>
</html>