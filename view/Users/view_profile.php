<?php
session_start();
include("../../controller/db_connection.php");
if (!isset($_SESSION['user'])) {
	header("location: ../login.php");
}
if(isset($_SESSION['user']))
{
    $u = unserialize($_SESSION['user']);
    
    $name = empty($u->name) ? $u->email : $u->name;
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
    <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(function(){
			 initiateFollow();
		});

		function initiateFollow() {  
			  $("a.unfollow").bind("mouseover",function(){
			   //$(this).children("img").attr("src","/soundcloud/assets/img/follow.png");
			   $(this).children("span").text("UnFollow");
			  });

			  $("a.unfollow").bind("mouseout",function(){
			   //$(this).children("img").attr("src","/soundcloud/assets/img/following.png");
			   $(this).children("span").text("Following");
			  }); 
			  
			  $("a.unfollow").bind("click",function(){  
                $.ajax({
                             url: '../../controller/follow.php', 
                             data: {id: <?php echo $_GET['id'];?>},
                                error: function() {
     							 $('#info').html('<p>An error has occurred</p>');
  												 },
                            
                             type: 'POST' ,
                                    success: function(id){
                                        //location.reload();
                                    }});
			    $(this).children("a.unfollow span").text("Follow");
			    $(this).removeClass("unfollow");
			    $(this).addClass("follow");
			    $(this).unbind();
			    initiateFollow();
			  });
			  
			  $("a.follow").bind("click",function(){
			    //$(this).children("img").attr("src","/soundcloud/assets/img/follow.png");
			    $.ajax({
                             url: '../../controller/follow.php', 
                             data: {id: <?php echo $_GET['id'];?>},
    		                           error: function() {
      					$('#info').html('<p>An error has occurred</p>');
   									},
  		                           type: 'POST' ,
                                    success: function(id){
                                        //location.reload();
                        	}});
			    $(this).children("span").text("UnFollow");
			    $(this).removeClass("follow");
			    $(this).addClass("unfollow");
			    $(this).unbind();
			    initiateFollow();
			  });
		}
	</script>
	<style type="text/css" media="screen">
a.button {
    text-align: center;
    background-origin: padding-box;
    background-size: auto;
    border-bottom-left-radius: 3px;
    border-bottom-right-radius: 3px;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    border-left-style: solid;
    border-left-width: 1px;
    border-right-style: solid;
    border-right-width: 1px;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    border-top-style: solid;
    border-top-width: 1px;
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    font-size: 20px;
    font-style: normal;
    font-variant: normal;
    font-weight: bold;
    line-height: 23px;
    outline-color: rgb(255, 255, 255);
    outline-style: none;
    outline-width: 0px;
    text-decoration: none;
    text-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 0px;
    vertical-align: middle;
    padding: 15px 30px 15px 30px;
    zoom: 1;
    width: 180px;
}

a.follow {
    background-image: linear-gradient(rgb(0, 150, 255), rgb(0, 93, 255));
    color: rgb(255, 255, 255);
    border-bottom-color: rgb(0, 113, 224);
    border-left-color: rgb(0, 113, 224);
    border-right-color: rgb(0, 113, 224);
    border-top-color: rgb(0, 113, 224);
}

a.follow:hover,a.follow:active {
    background: linear-gradient(#008aea, #024dcf);
    border-color: #0055a7;
}

/*a img {
    width: 14px;
    margin-right: 3px;
}*/

a.unfollow {
    color: #FFFFFF;
    background: #3eef1f;
    background: -webkit-gradient(linear, 0% 40%, 0% 70%, from(#3eef1f),
        to(#35cc1a));
    background: -moz-linear-gradient(linear, 0% 40%, 0% 70%, from(#3eef1f),
        to(#35cc1a));
    border-bottom-color: #dcdcdc;
    border-left-color: #dcdcdc;
    border-right-color: #dcdcdc;
    border-top-color: #dcdcdc;
}

a.unfollow:hover,a.unfollow:active {
    background: linear-gradient(#eb3845, #d9030a);
    border-color: #e7473c;
    color: #fff;
}
</style>
</head>
<body>
<?php include_once '../layout/header.php'; ?>
	<div class="container">
		<?php 
		$db_connect = db_connect();
		$id= isset($_GET['id']) ? $_GET['id'] : '';
		if($id==$u->userID) {
			 echo "<script> window.location = \"profile.php \"; </script>";
		}
		$query="SELECT * FROM user WHERE userID = '$id'";
		$result=mysql_query($query,$db_connect) or die ("Error in query: $query");
		$num_row=mysql_num_rows($result);
		if ($num_row==1)
		{
			 $p = mysql_fetch_object($result);
		
		echo "<h1>",$p->name,"'s profile</h1></br>";
		?>
		<div class="col span1"><h3>Address</h3></div>
		<div class="col span2"><h3><?php echo $p->address ?></h3></div><br/>
		<span><img id="ava" src="../../assets/img/uploads/<?php echo $p->avatar;?>" height="300" /></span>
		<div class="col span1"><h3>DOB</h3></div>
		<div class="col span2"><h3><?php echo $p->dob ?></h3></div><br/>

		<div class="col span1"><h3>Gender</h3></div>
		<div class="col span2"><h3><?php echo $p->gender ?></h3></div><br/>
		<div class="col span1"><h3>Bio</h3></div>
		<div class="col span2"><h3><?php echo $p->bio ?></h3></div><br/>
		<br/>
		<?php
		$query="SELECT * FROM follow WHERE userID1='$u->userID' and userID2='$p->userID'";
		$result=mysql_query($query,$db_connect) or die ("Error in query: $query");
		$num_row = mysql_num_rows($result);
		if ($num_row==0)	{
		?>
		<a  class="button follow" style="text-decoration: none;"><img width="10px" /> <span>Follow</span></a>
	<?php 
	} 	else{
	?>		
		<a  class="button unfollow" style="text-decoration: none;"><img width="10px" /> <span>Following</span></a>
    <?php
	}   
	?>
        <br><br>
        <a href="/soundcloud/view/Users/follower_list.php?id=<?php echo $p->userID;?>"  title="">View followers list</a>
        <div id="all_tracks"></div>
	</div>
</body>
</html>
<?php 
}
} ?>
