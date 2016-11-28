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
    <link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/custom2.css">
    <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
    <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
</head>
<body>
<?php include_once '../layout/header.php'; ?>
	<div class="container container3">
		<?php 
		echo "<h1>Hello ",$name,"</h1></br>"; 
        ?>

        <div id="all_tracks"><div id="del">
            <?php
                $db_connect = db_connect();
                $query = "SELECT * FROM song WHERE userID = '$u->userID' ORDER BY songID DESC ";
                $result = mysql_query($query,$db_connect)or die ("Error in query: $query");
                $num_row = mysql_num_rows($result);
                // $arr = mysql_fetch_array($result);
                if ($num_row > 0) {
                    while ($row = mysql_fetch_array($result)) {
                    ?> 
                    <button type="button"  class="del audiobtnplaybgrd myBtn<?php echo $row['songID']; ?>" >x</button>
                    <script>
                    $(document).ready(function(){
                        $(".myBtn<?php echo $row['songID']; ?>").click(function(){
                            $("#myModal").modal();
                            $(".modal-body").html("Delete \"<?php echo $row['title']; ?>\" ?");
                            $("#del_track").click(function() {
                                $('#loading').show();
                                $.ajax({
                                    url: '../../controller/del_track.php', 
                                    data: {id: <?php echo $row['songID']; ?>,},
                                    dataType: 'text',
                                    type: 'POST' ,
                                    success: function(id){
                                        location.reload();
                                    }});
                                
                            });
                        });
                    });
                    </script>
                    <?php
                }}
                ?>
        </div>
        <div id="edit_track">
            <?php
                $query = "SELECT * FROM song WHERE userID = '$u->userID' ORDER BY songID DESC ";
                $result = mysql_query($query,$db_connect)or die ("Error in query: $query");
                $num_row = mysql_num_rows($result);
                
                // $arr = mysql_fetch_array($result);
                if ($num_row > 0) {
                    while ($row = mysql_fetch_array($result)) {
                    ?> 
                    <a style="text-decoration: none;" href="upload_edit.php?id=<?php echo $row['songID']; ?>" title=""><button type="button" class="audiobtnplaybgrd edit_track">Edit</button></a>
                    <?php
                }}
                ?>
        </div>
        </div>
    </div>
<?php 
    $query = "SELECT * FROM song WHERE userID = '$u->userID' ORDER BY songID DESC ";
    $result = mysql_query($query,$db_connect)or die ("Error in query: $query");
    $num_row = mysql_num_rows($result);
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
        ];

    //Make a player and display help
    //player([tracklist], [show waveform?], [show help?])
    tinyplayer(TrackList, false,true);
</script>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" id="modal-content">
      <img src="/soundcloud/assets/img/loading.gif" id="loading" alt="" width="600">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-remove"></span> Delete ?</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">

        </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
              <button type="submit" id="del_track" class="btn btn-danger btn-default pull-right" ><span class="glyphicon glyphicon-remove"></span> Delete it!</button>
          </div>
        
      </div>
      
    </div>
  </div>

</body>

</html>
<?php } db_closeconnect($db_connect); ?>
<?php include_once '../layout/footer.php'; ?>