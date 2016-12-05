<?php
session_start();
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

include_once("db_connection.php");
$user_id = -1;
if(isset($_SESSION['user'])){
    $u = unserialize($_SESSION['user']);
    $user_id = $u->userID;
}

$song_id = json_decode($_POST['songID']);
$db_connect = db_connect();
//mysql_query("SET NAMES 'utf8'");
//mysql_query("SET CHARACTER SET utf8");
//mysql_query("SET SESSION collation_connection = 'utf8_unicode_ci'");

$query = "select *
from user as u,
  (
    select count(songID) as totalsongs from song where userID in (select userID from song where songID = $song_id)
    ) as usersong,
    (
    select title as songtitle, uploadTime from song where songID = $song_id
    ) as songinfo
where userID in (select userID from song where songID = $song_id)";

$result = mysql_query($query, $db_connect) or die ("Error in query: $query");
$num_row = mysql_num_rows($result);
if($num_row!=1){
    echo "Đã có lỗi xảy ra!";
    return;
}
$info = array();
$row = mysql_fetch_array($result);
$info['userID']         = $row['userID'];
$info['name']           = $row['name'];
$info['avatar']         = $row['avatar'];
$info['followercount']  = $row['followercount'];
$info['totalsongs']     = $row['totalsongs'];
$info['address']        = $row['address'];
$info['songtitle']      = $row['songtitle'];
$info['uploadTime']     = $row['uploadTime'];

if($user_id == $info['userID']){
    $action_btn_text = "Profile";
} else
    $action_btn_text = "Follow";

$gen_html['bottom'] = '
    <div style="height:120px;">
        <a class="avatar-wrapper" href="/soundcloud/view/Users/index.php?id=' .$info['userID']. '">
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
        <div class="uploader-action" data-uploader-id="'.$info['userID'].'">
            <a href="/soundcloud/view/Users/index.php?id=' .$info['userID']. '">
                <button>'.$action_btn_text.'</button>
            </a>
        </div>
    </div>
';
$gen_html['cover'] = '
    <div class="profile"
         style="background: transparent linear-gradient(315deg, rgb(230, 132, 110) 0%, rgb('.$info['userID'].', 132, 133) 100%) repeat scroll 0% 0%;">
        <div class="profile-info-wrapper">
            <div class="profile-song-title">'.$info['songtitle'].'</div>
            <div class="profile-song-uploaded-for">'. time_elapsed_string($info['uploadTime']) .'</div>
            <div class="clearfix"></div>
            <div class="profile-uploader-name">by '.$info['name'].'</div>
        </div>
    </div>
';

echo json_encode($gen_html);