<?php
session_start();
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
	<link rel="icon"  href="/soundcloud/assets/ico/1.ico"/>
    <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
    <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
</head>
<body>
<?php include_once '../layout/header.php'; ?>
	<div class="container">
		<?php 
		echo "<h1>Hello ",$name,"</h1></br>";
		?>
		<div class="col span1"><h3>Address</h3></div>
		<div class="col span2"><h3><?php echo $u->address ?></h3></div><br/>
		<span><img id="ava" src="../../assets/img/uploads/<?php echo $link;?>" height="300" /></span>
		<div class="col span1"><h3>DOB</h3></div>
		<div class="col span2"><h3><?php echo $u->dob ?></h3></div><br/>

		<div class="col span1"><h3>Gender</h3></div>
		<div class="col span2"><h3><?php echo $u->gender ?></h3></div><br/>
		<div class="col span1"><h3>Bio</h3></div>
		<div class="col span2"><h3><?php echo $u->bio ?></h3></div><br/>
		<br/>
		<form method="POST" action="profile_edit.php">
		<br/>
		<br/>
			<input class="btn" type="submit" value="Edit your profile" name="edit">
		</form>

        <br><br>

        <div id="all_tracks"></div>
	</div>

<script>
    /* Tiny HTML5 Music Player by Themistokle Benetatos */
    TrackList =
        [
        <?php 
      		define("PATH_MEDIA_FILES", "../../data/");
			$file = scandir (PATH_MEDIA_FILES.$u->userID."/");
			array_splice($file, 0, 2);
			$count = count($file);
			foreach ($file as $key => $value) {
				$value2 = explode('.',$value);
		?>
            {
                url: '<?php echo PATH_MEDIA_FILES.$u->userID.'/'.$value ?>',
                title:'<?php echo $value2[0]; ?>',
                year:'2007',
                
            }
        <?php if ($count == $key)
        	{ echo "";}
        	else {echo ",";}
          } ?>
            // {
            //     url:'/soundcloud/data/2.mp3',
            //     title:'Right of Stupidity',
            //     year:'2004'
            // }
        ];

    //Make a player and display help
    //player([tracklist], [show waveform?], [show help?])
    tinyplayer(TrackList, false);
</script>

</body>
</html>
<?php } ?>