<?php
session_start();
include_once("db_connection.php");
$song_id = json_decode($_POST['songID']); /// should be post
$db_connect = db_connect();
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection = 'utf8_unicode_ci'");

$query = "select *
from user as u,
  (
    select count(songID) as totalsongs from song where userID in (select userID from song where songID = $song_id)
    ) as usersong
where userID in (select userID from song where songID = $song_id)";

$result = mysql_query($query, $db_connect) or die ("Error in query: $query");
$num_row = mysql_num_rows($result);
if($num_row!=1){
    echo "Đã có lỗi xảy ra!";
    return;
}
$info = array();
$row = mysql_fetch_array($result);
$info['userID']        = $row['userID'];
$info['name']          = $row['name'];
$info['avatar']        = $row['avatar'];
$info['followercount'] = $row['followercount'];
$info['totalsongs']    = $row['totalsongs'];

$gen_html = '
    <div style="height:120px;">
        <a class="avatar-wrapper" href="/soundcloud/view/Users/view_profile.php?id=' .$info['userID']. '">
            <div class="avatar"
                 style=background-image:url("/soundcloud/assets/img/uploads/' .$info['avatar']. '");></div>
        </a>
    </div>
    <div class="uploader-info">
        <div class="uploader-name">'.$info['name'].'</div>
        <div class="uploader-stat">
            <div class="followed" title="'.$info['followercount'].' followers">
                <i class="fa fa-users" aria-hidden="true"></i>
                <div class="uploader-followed">'.$info['followercount'].'</div>
            </div>
            <div class="total-songs" title="'.$info['totalsongs'].' tracks">
                <i class="fa fa-music" aria-hidden="true"></i>
                <div class="uploader-total-songs">'.$info['totalsongs'].'</div>
            </div>

        </div>
        <div class="uploader-action" data-uploader-id="'.$info['userID'].'">Follow button</div>
    </div>
';
echo $gen_html;
