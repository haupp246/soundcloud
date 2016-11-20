<?php 
$u = isset($_SESSION['user']) ? unserialize($_SESSION['user']) :'';
?>
<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css"/>
<style type="text/css" media="screen">
	.container{
		padding-top: 50px;
	}
	.navbar{
		position: fixed;
		background-color: red;
		width: 100%;
		height: 50px;
		background-color: #333333;
		border-radius: 0;
		box-shadow: 0px 0px 10px black;

	}
	.navbar>li:first-child{
		background-clip: border-box;
		background-color: rgb(255, 72, 0);
	}
	.navbar>li{
		display: inline-flex;
		float: left;
		height: 50px;
		margin-right: 20px;
		position: relative;
		top: -1px;
		/* border-right: 1px solid black; */
		padding-right: 15px;
	}
	.navbar a{
		display: flex;
		margin: auto;
		text-decoration: none;
		color: rgb(204, 204, 204);
	}
	.navbar form{
		position: relative;
		top: 10px;
	}
	input[name='searchBar']{
		width: 600px;
		height: 30px;
		padding-left: 10px;
		border-radius: 3px;
	}
	input[name='searchSubmit']{
		width: 20px;
		height: 20px;
		position: absolute;
		right: 3px;
		top: 5px;
		background-color: white;
		background-image: url('../../assets/img/Search.png');
		background-repeat: no-repeat;

	}

</style>
<ul class="navbar">
	<li><a href="" title=""><img src="../../assets/img/logo.png" height="50px" alt=""></a></li>
	<li><a href="" title="">Home</a></li>
	<li><a href="" title="">Overview</a></li>
	<li><div>
		<form action="" method="POST" accept-charset="utf-8">
			<input type="text" name="searchBar" placeholder="Search">
			<input type="submit" class="btn" name="searchSubmit" value="">
		</form>
	</div></li>
	<?php if(!isset($_SESSION['user'])) { ?>	
	<li><a href="view/signup.php"><input type="button" class="btn" value="Join us now !"></a></li>
	<li><a href="view/login.php"><input type="button" class="btn" value="Sign In"></a></li>
	<?php } else { ?>
	<li><a href="" title="">Upload</a></li>
	<li><a href="" title="">Profile</a></li>
	<li><a href="" title=""><img src="../../assets/img/bell.png" height="25px" alt=""></a></li>
	<?php } ?>
</ul>
	