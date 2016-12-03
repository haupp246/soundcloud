<?php
session_start();
include_once("db_connection.php");
$u = unserialize($_SESSION['user']);
$db_connect = db_connect();
$checkFlag = FALSE;
$countOld = $_POST['count'];
$countNew = 0;
function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);
	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}
	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
}
$query = "SELECT * FROM follow INNER JOIN user on follow.userID1 = user.userID WHERE userID2 = {$u->userID} ORDER BY time DESC";
$result = mysql_query($query,$db_connect)or die("Error in query $query");
$num_row = mysql_num_rows($result);
if ($num_row >0)
{
	$checkFlag = TRUE;
	while ($row = mysql_fetch_assoc($result)) {
		$time =  date("H:i:s d-m-Y",strtotime($row['time']));
		echo "<li id='".intval(strtotime($row['time']))."'><a href=\"/soundcloud/view/Users/index.php?id=".$row['userID']."\">".$time."<br>".$row['name']." has followed you</a></li>";
		$countNew++;

	}
}
//like
$query2 =    "SELECT * FROM  song INNER JOIN  likesong  ON likesong.songID = song.songID INNER JOIN user ON  likesong.userID = user.userID  WHERE song.userID = {$u->userID} ";
$result2 = mysql_query($query2,$db_connect)or die("Error in query $query2");
$num_row2 = mysql_num_rows($result2);
if ($num_row2 >0)
{
	$checkFlag = TRUE;
	while ($row2 = mysql_fetch_assoc($result2)) {
		$time2 =  date("H:i:s d-m-Y",strtotime($row2['time']));
        echo "<li id='".intval(strtotime($row2['time']))."'><a href=\"/soundcloud/view/playsong.php?id=".$row2['songID']."\">".$time2."<br>".$row2['name']." has liked ".$row2['title']."</a></li>";
		$countNew++;
	}
}
//comment song
$query = "SELECT * FROM  song INNER JOIN  comment  ON comment.songID = song.songID INNER JOIN user ON  comment.userID = user.userID  WHERE song.userID = {$u->userID} ";
$result = mysql_query($query,$db_connect)or die("Error in query $query");
$num_row = mysql_num_rows($result);
if ($num_row >0)
{
	$checkFlag = TRUE;
	while ($row = mysql_fetch_assoc($result)) {
		$time =  date("H:i:s d-m-Y",strtotime($row['time']));
		echo "<li id='".intval(strtotime($row['time']))."'><a href=\"/soundcloud/view/playsong.php?id=".$row['songID']."\">".$time."<br>".$row['name']." has commented in  ".$row['title']."</a></li>";
		$countNew++;
	}
}
//comment playlist
$query = "SELECT * FROM playlist INNER JOIN  comment  ON comment.playlistID = playlist.playlistID INNER JOIN user ON  comment.userID = user.userID  WHERE playlist.userID = {$u->userID} ";
$result = mysql_query($query,$db_connect)or die("Error in query $query");
$num_row = mysql_num_rows($result);
$count=0;
if ($num_row >0)
{
	while ($row = mysql_fetch_assoc($result)) {
		$time =  date("H:i:s d-m-Y",strtotime($row['time']));
		echo "<li id='".intval(strtotime($row['time']))."'><a href=\"/soundcloud/view/playlist.php?id=".$row['playlistID']."\">".$time."<br>".$row['name']." has commented in your playlist </a></li>";
		$countNew++;
	}
}
if (!$checkFlag){
	$check = (is_numeric($countOld) AND ($countNew > $countOld - 1) AND ($countOld - 1 > 0 ))? '1' : '0';
	echo "<li><a>You have no notification</a><input type='hidden' id='checkNew' value='{$check}'></li>";

}
else{
	$check = (is_numeric($countOld) AND $countNew > $countOld - 1)? '1' : '0';
	echo "<li><input type='hidden' id='checkNew' value='{$check}'></li>";
}

?>
