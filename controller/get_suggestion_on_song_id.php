<?php
include_once("db_connection.php");
$user_id = -1;
if(isset($_SESSION['user'])){
	$u = unserialize($_SESSION['user']);
	$user_id = $u->userID;
}

$song_id = json_decode($_POST['songID']);
$uploader_id = json_decode($_POST['uploaderID']);
$genre = json_decode($_POST['genre']);
$db_connect = db_connect();
$query_s = "SELECT * FROM song WHERE userID='$uploader_id' and songID <> '$song_id' ORDER BY RAND() LIMIT 3";
$result_s = mysql_query($query_s, $db_connect) or die ("Error in query: $query");
$num_row_s = mysql_num_rows($result_s);
$gen_html ='<h2>
Suggestion:

</h2>';
if ($num_row_s==0) $gen_html .= "This user do not have any other song.";
else
{
	$gen_html .= "This user have also uploaded:<br/><hr/>";
	while($row_s = mysql_fetch_assoc($result_s)){
		$image_s = isset($row_s['image'])? $row_s['image'] :"default.png";

		$gen_html .= '    
		<div>
			<a href ="playsong.php?id='.$row_s['songID'].'">
				<div class = "row">
					<div class = "col-md-3">
						<img width="60px" height="60px" src="/soundcloud/assets/img/song/'.$image_s.'">
					</div>
					<div class = "col-md-9">
						<div>'.$row_s['title'].'</div>
					</div>
				</div>
			</a>
		<br/>
		</div>
		';
	}
}
$query_s = "SELECT * FROM song WHERE genre like '%$genre%' and songID <> '$song_id' ORDER BY RAND() LIMIT 3";
$result_s = mysql_query($query_s, $db_connect) or die ("Error in query: $query");
$num_row_s = mysql_num_rows($result_s);

if ($num_row_s==0) $gen_html .= "No song.";
else
{
	$gen_html .= "Song you may like:<br/><hr/>".$genre;
	while($row_s = mysql_fetch_assoc($result_s)){
		$image_s = isset($row_s['image'])? $row_s['image'] :"default.png";

		$gen_html .= '    
		<div>
			<a href ="playsong.php?id='.$row_s['songID'].'">
				<div class = "row">
					<div class = "col-md-3">
						<img width="60px" height="60px" src="/soundcloud/assets/img/song/'.$image_s.'">
					</div>
					<div class = "col-md-9">
						<div>'.$row_s['title'].'</div>
					</div>
				</div>
			</a>
		<br/>
		</div>
		';
	}
}
echo json_encode($gen_html);
?>
