<?php 
$u 		= isset($_SESSION['user']) ? unserialize($_SESSION['user']) :'';
$link 	= isset($u->avatar) ? $u->avatar : '';
$linkav = '/soundcloud/assets/img/uploads/'.$link;
?>
<link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/bootstrap.css"/>
<style type="text/css" media="screen">
	body{
		background-color: #F2F2F2;
	}
	body>div:first-of-type{
		min-height: 300px;
	}
	.container{
		padding-top: 50px;
		background-color: white;
		padding: 50px;
		z-index: 1;
	}
	#navbar{
		position: fixed;
		background-color: red;
		width: 100%;
		height: 50px;
		background-color: #333333;
		border-radius: 0;
		box-shadow: 0px 0px 10px black;
		display:flex;
	    align-items: center; 
	    justify-content: center;
	    z-index: 99999;
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
		background-image: url('/soundcloud/assets/img/Search.png');
		background-repeat: no-repeat;
	}
	#ava{
		/* position: absolute; */
		display: inline-flex;
		float: right;
		z-index: 2;
	}
	.col{
		display: inline-block;
	}
	.span1{
		width: 25%;
		float: left;
		min-height: 52px;
	}
	.span2{
		
		min-height: 52px;	
	}
	input[type="button"]{
		color: black;
	}
	.container2{
		padding-top: 100px;
		width: 400px;
		height: 600px;
		margin: auto;
	}
	input[name="name"],input[name="pass"],input[name="email"],input[name="pass2"]{
		width: 400px;
		height: 40px;
		border-radius: 5px;
		padding-left: 10px;
		font-size: 1.1em; 
	}
	h1{
		display: block;
		
		text-align: center;
	}
	div.ava{
		height: 30px;
		width: 30px;
		border-radius: 100px;
		background-color: red;
		background-image: url( <?php echo $linkav;?> );
		background-size: 100%;
		margin-right: 10px;
	}
	.dropdown:hover .dropdown-menu {
    display: block;
 	}
 	.dropdown-menu{
 		z-index: 3;
 		margin: 0px;
 	}
 	.navbar>li>a>img{
		padding-left: 15px;
		padding-right: 0px;
		margin-right: 0px;
	}

</style>
<ul id="navbar" class="navbar">
	<li><a href="/soundcloud/" title=""><img src="/soundcloud/assets/img/logo.png" height="50px" alt="" ></a></li>
	<li><a href="" title="">Home</a></li>
	<li><a href="" title="">Overview</a></li>
	<li><div>
		<form action="" method="POST" accept-charset="utf-8">
			<input type="text" name="searchBar" placeholder="Search">
			<input type="submit" class="btn" name="searchSubmit" value="">
		</form>
	</div></li>
	<?php if(!isset($_SESSION['user'])) { ?>	
	<li><a href="/soundcloud/view/signup.php"><input type="button" class="btn btnn" value="Join us now !"></a></li>
	<li><a href="/soundcloud/view/login.php"><input type="button" class="btn btnn" value="Sign In"></a></li>
	<?php } else { ?>
	<li><a href="/soundcloud/view/Users/upload.php" title="">Upload</a></li>
	<li class="dropdown"><a href="/soundcloud/view/Users/index.php" title="">
		<div class="ava"></div>
		<a href="/soundcloud/view/Users/index.php" title=""><?php echo $u->name ?></a>
		</a>
		<ul class="dropdown-menu">
			<li><a href="/soundcloud/view/Users/profile.php" title="">Profile</a></li>
			<li><a href="/soundcloud/view/Users/users_list.php" title="">List User</a></li>
			<li><a href="" title="">Suggest</a></li>
			<li><a href="" title="">Go Pro</a></li>
			<li><a href="/soundcloud/view/Users/delete.php" title="">Delete Account</a></li>
			<li><a href="/soundcloud/controller/logout.php" title="">Log Out</a></li>
		</ul>
		</li>
	<li><a href="" title=""><img src="/soundcloud/assets/img/bell.png" height="25px" alt=""></a></li>
	<?php } ?>
</ul>

