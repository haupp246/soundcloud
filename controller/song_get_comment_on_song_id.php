<?php
session_start();
include_once("db_connection.php");

$song_id = json_decode($_POST['songID']);
$db_connect = db_connect();
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection = 'utf8_unicode_ci'");

$query = "SELECT cmtID, time, content, c.userID AS commentUserID, songID,
				u.userID, name, avatar
	 		FROM comment AS c 
	 		JOIN user AS u ON c.userID = u.userID 
	 		WHERE c.songID = $song_id
	 		ORDER BY time desc";
$result = mysql_query($query, $db_connect) or die ("Error in query: $query");
$num_row = mysql_num_rows($result);
if ($num_row == 0) {
    echo "Seems a little quiet over here<br>Be the first to comment on this track ";
    return;
}
$i = 0;
$gen_html = '
    <div class="total-comments">
        <i class="fa fa-comments" aria-hidden="true"></i>
        <div class="content">' . $num_row . ' comments</div>
    </div>
    ';
while ($row = mysql_fetch_array($result)) {
//		$comments[$i]['cmtID'] 			= $row['cmtID'];
//		$comments[$i]['time'] 			= $row['time'];
//		$comments[$i]['content'] 		= $row['content'];
//		$comments[$i]['commentUserID'] 	= $row['commentUserID'];
//		$comments[$i]['songID'] 		= $row['songID'];
//		$comments[$i]['userID'] 		= $row['userID'];
//		$comments[$i]['name'] 			= $row['name'];
//		$comments[$i]['avatar'] 		= $row['avatar'];
//		$i++;
    $gen_html .= '
        <div class="comment" data-comment-id="' . $row['cmtID'] . '">
            <a class="avatar-wrapper" href="/soundcloud/view/Users/view_profile.php?id=' . $row['commentUserID'] . '">
                <div class="avatar"
                     style="background-image:url(\'/soundcloud/assets/img/uploads/' . $row['avatar'] . '\');"></div>
            </a>
            <div class="comment-content-wrapper">
                <div class="content-time">' . $row['time'] . '</div>
                <a class="content-username-wrapper" href="/soundcloud/view/Users/view_profile.php?id=' . $row['commentUserID'] . '">
                    <div class="content-username">' . $row['name'] . '</div>
                </a>
                <div class="content-body">' . $row['content'] . '</div>
            </div>
        </div>
    ';
}
echo $gen_html;
