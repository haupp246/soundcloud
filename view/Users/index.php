<?php
session_start();
include_once("../../controller/db_connection.php");
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
		

        <div id="all_tracks"></div>
	       </div>
<?php 
	$db_connect = db_connect(); 
    $query = "SELECT * FROM song WHERE userID = '$u->userID' ";
    $result = mysql_query($query,$db_connect)or die ("Error in query: $query");
    $num_row = mysql_num_rows($result);
    
    // $arr = mysql_fetch_array($result);
    

?>
<script>
    /* Tiny HTML5 Music Player by Themistokle Benetatos */
    TrackList =
        [
        <?php 

      		define("PATH_MEDIA_FILES", "../../data/");
			$file = scandir (PATH_MEDIA_FILES.$u->userID."/");
			array_splice($file, 0, 2);
			$count = count($file);
			// foreach ($file as $key => $value) {
			// 	$value2 = explode('.',$value);
			if ($num_row > 0) {
	    		while ($row = mysql_fetch_array($result)) {
		    		
		?>
            {
                url: "<?php echo PATH_MEDIA_FILES.$u->userID.'/'.$row['name'] ?>",
                title:"<?php echo $row['songID']." - ".$row['title'] ; ?>",
                year:"<?php echo !empty($row['artist']) 	? 	$row['artist'] 		: '';
                			echo !empty($row['album'])	? " - ".$row['album'] 	: '';
                			echo ($row['year'] != 0) 	? " - ".$row['year']	: ''; ?>",
                
            }
        <?php if ($row == $num_row)
        	{ echo "";}
        	else {echo ",";}
          }
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
<?php include_once '../layout/footer.php'; ?>