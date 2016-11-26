<?php 
session_start();
include_once 'layout/header.php';
if(isset($_SESSION['user']))
{
	$u = unserialize($_SESSION['user']);
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
	<link rel="stylesheet" type="text/css" href="/soundcloud/lib/font-awesome-4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
	<link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/song.css">

	<script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
</head>

<body>
	<?php include_once 'layout/header.php'; ?>
	<div class="container">
		<div id="all_tracks"></div>
		<div id="comments">
			<div class="uploader">
				<div style="height:120px;">
					<a class="avatar-wrapper" href="/soundcloud/view/Users/view_profile.php?id=1">
						<div class="avatar" style="background-image:url('/soundcloud/assets/img/default.png');"></div>
					</a>
				</div>
				<div class="uploader-info">
					<div class="uploader-name">truongnm2</div>
					<div class="uploader-stat">
						<i class="fa fa-users" aria-hidden="true"></i>
						<div class="uploader-followed">8541</div>
					</div>
					<div class="uploader-action">Follow buttons</div>
				</div>
			</div>
			<div class="comment-wrapper">
				<a class="avatar-wrapper" href="/soundcloud/view/Users/view_profile.php?id=1">
					<div class="avatar" style="background-image:url('/soundcloud/assets/img/default.png');"></div>
				</a>
				<div class="comment-content-wrapper">
					<div class="content-time">2016-11-24 15:34:29</div>
					<a class="content-username-wrapper" href="/soundcloud/view/Users/view_profile.php?id=1">
						<div class="content-username">truongnm2</div>
					</a>
					<div class="content-body">Hay phết đấy 984984</div>
				</div>
			</div>
		</div>


<!-- avatar : "default.jpg"
cmtID:"6"
commentUserID:"5"
content:"Hay phết đấy 984984"
name:"truongnm2"
songID:"55"
time:"2016-11-24 15:34:29"
userID:"5" -->
</div>

<script type="text/javascript">
	TrackList = 
	[
	{
		url:'/soundcloud/data/5/A Cup Of Coffee.mp3',
		title:'A Cup Of Coffee',
		year:'2007'
	}
	];
	tinyplayer(TrackList, false,true);

	$(document).ready(function(){
		var songID = <?php echo $_GET['id']?>;
		$.ajax({
			url: '../controller/song_get_comment_on_song_id.php', 
			data: {songID:songID},
			dataType: 'json',
			type: 'POST' ,
			success: function(data){
                    // console.log(data);
                    var comments_view = "";
                    for (var i = 0, len = data.length; i < len; i++) {
                    	console.log(data[i]);
                    }
                    // $("#comments").html(comments_view);
                }
            });
	})
</script>
</body>
</html>
<?php include_once 'layout/footer.php'; ?>