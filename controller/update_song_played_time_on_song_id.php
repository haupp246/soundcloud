<?php
/**
 * Created by IntelliJ IDEA.
 * User: truon
 * Date: 12/1/2016
 * Time: 10:42 AM
 */
include_once("db_connection.php");
$data = $_POST['data'];
$view_count = $data['viewCount'];
$view_count++;
$song_id = $data['songID'];

$db_connect = db_connect();
$query = "UPDATE `song` SET `viewCount` = '{$view_count}' WHERE `song`.`songID` = {$song_id};";
$result = mysql_query($query, $db_connect) or die ("Error in query: $query");
db_closeconnect($db_connect);

$result = array();
$result['result'] = $view_count;
$result['success'] = "complete";
echo json_encode($result);
