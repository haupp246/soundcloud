<?php
session_start();
include_once("../../controller/db_connection.php");
$another_user_id = isset($_GET['id']) ? $_GET['id'] : -1;
$isLogged = FALSE;
if (isset($_SESSION['user'])) {
    $isLogged = TRUE;
}
if ($another_user_id == -1 && !$isLogged) {
    echo "404 - Page not found";
    die();
}

include_once '../layout/header.php';
$db_connect = db_connect();

$another_user_id = isset($_GET['id']) ? $_GET['id'] : -1;

$this_profile = array();

if ($another_user_id != -1) {
    if ($isLogged) {
        if ($another_user_id == unserialize($_SESSION['user'])->userID) {
            $this_profile = unserialize($_SESSION['user']);
            $this_profile->type = "me";
            $this_profile->follow = 0;
        } else {
            $this_profile = get_user_info_from_get_id($another_user_id, $db_connect);
            $this_profile->type = "not-me";
            $my_id = unserialize($_SESSION['user'])->userID;

            // check if I follow this guy
            $query = "SELECT * FROM follow WHERE userID1='$my_id' and userID2='$another_user_id'";
            $result = mysql_query($query, $db_connect) or die ("Error in query: $query");
            $num_row = mysql_num_rows($result);
            if ($num_row == 0) {
                $this_profile->follow = 0;
            } else $this_profile->follow = 1;
        }
    } else {
        $this_profile = get_user_info_from_get_id($another_user_id, $db_connect);
        $this_profile->type = "guest";
    }
} else {
    if ($isLogged) {
        $this_profile = unserialize($_SESSION['user']);
        $this_profile->type = "me";
    }
}

function get_user_info_from_get_id($another_user_id, $db_connect) {
    $query = "SELECT * FROM user WHERE userID = '$another_user_id';";
    $result = mysql_query($query, $db_connect) or die ("Error in query: $query");
    $num_row = mysql_num_rows($result);
    if ($num_row == 0) {
        echo "404 - User not exist";
        die();
    }
    return $this_profile = mysql_fetch_object($result);
}

?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>HTTV music – Music makes me</title>
        <meta name="author" content="ThaiVH"/>
        <meta name="description" content="soundcloud"/>
        <meta name="keyword" content="sound, cloud, music"/>
        <meta charset="utf-8"/>
        <link rel="icon" href="/soundcloud/assets/ico/1.ico"/>
        <link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/custom2.css">
        <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
        <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>

    </head>
    <body>
    <div class="container container3">
        <!--		--><?php //
        //		echo "<h1>Hello ",$name,"</h1></br>";
        //
        ?>

        <div class="profile"
             style="background: transparent linear-gradient(315deg, rgb(230, 132, 110) 0%, rgb(<?php echo $this_profile->userID ?>, 132, 133) 100%) repeat scroll 0% 0%;">
            <div class="profile-avatar"
                 style="background-image: url('<?php echo "/soundcloud/assets/img/uploads/" . $this_profile->avatar ?>')"></div>
            <div class="profile-info-wrapper">
                <div class="profile-info"><?php echo $this_profile->name ?></div>
                <div class="profile-address">from <?php echo $this_profile->address ?></div>
            </div>
        </div>

        <div class="clearfix"></div>

        <ul class="nav nav-tabs tabs-select">
            <li class="active"><a data-toggle="tab" href="#tracks">Tracks</a></li>
            <li><a data-toggle="tab" href="#playlists">Playlists</a></li>
            <li class="profile-detail">
                <?php
                if ($this_profile->type == "guest") {
                    echo '
                        <div>
                            <a href="/soundcloud/view/login.php">
                                <button class="user-action follow" >Follow</button>
                            </a>
                        </div>
                        
                    ';
                } else if ($this_profile->type == "me") {
                    echo '
                        <a href="/soundcloud/view/Users/profile_edit.php" class="btn btn-default">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit profile
                        </a>
                    ';
                } else if ($this_profile->type == "not-me") {
                    if ($this_profile->follow == 0) {
                        echo '
                            <div class="">
                                <button class="user-action unfollow" data-user-id="' . $this_profile->userID . '">Follow</button>
                                <a href="/soundcloud/view/Users/index.php?id=' . $this_profile->userID . '" class="btn btn-default">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile detail
                                </a>
                            </div>
                        ';
                    } else {
                        echo '
                            <div class="">
                                <button class="user-action following" data-user-id="' . $this_profile->userID . '">Following</button>
                                <a href="/soundcloud/view/Users/index.php?id=' . $this_profile->userID . '" class="btn btn-default">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile detail
                                </a>
                            </div>
                        ';
                    }
                }
                ?>
            </li>
        </ul>

        <div class="tab-content">
            <div id="tracks" class="tab-pane fade in active">

                <div id="all_tracks">
                    <div id="del">
                        <?php
                        $query = "SELECT * FROM song WHERE userID = '$this_profile->userID' ORDER BY songID DESC ";
                        $result = mysql_query($query, $db_connect) or die ("Error in query: $query");
                        $num_row = mysql_num_rows($result);
                        // $arr = mysql_fetch_array($result);
                        if ($num_row > 0) {
                            while ($row = mysql_fetch_array($result)) {
                                if ($this_profile->type == "me") {
                                    echo '
                                         <button type="button" class="del audiobtnplaybgrd myBtn' . $row['songID'] . '">
                                            x
                                        </button>
                                    ';
                                }
                                ?>

                                <script>
                                    $(document).ready(function () {
                                        $(".myBtn<?php echo $row['songID']; ?>").click(function () {
                                            $("#myModal").modal();
                                            $(".modal-body").html("Delete \"<?php echo $row['title']; ?>\" ?");
                                            $("#del_track").click(function () {
                                                $('#loading').show();
                                                $.ajax({
                                                    url: '../../controller/del_track.php',
                                                    data: {id: <?php echo $row['songID']; ?>,},
                                                    dataType: 'text',
                                                    type: 'POST',
                                                    success: function (id) {
                                                        location.reload();
                                                    }
                                                });

                                            });
                                        });
                                    });
                                </script>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div id="edit_track">
                        <?php
                        $query = "SELECT * FROM song WHERE userID = '$this_profile->userID' ORDER BY songID DESC ";
                        $result = mysql_query($query, $db_connect) or die ("Error in query: $query");
                        $num_row = mysql_num_rows($result);

                        // $arr = mysql_fetch_array($result);
                        if ($num_row > 0) {
                            while ($row = mysql_fetch_array($result)) {
                                if ($this_profile->type == "me") {
                                    ?>
                                    <a style="text-decoration: none;"
                                       href="upload_edit.php?id=<?php echo $row['songID']; ?>"
                                       title="">
                                        <button type="button" class="audiobtnplaybgrd edit_track">Edit</button>
                                    </a>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div id="playlists" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                    totam rem aperiam.</p>
            </div>
        </div>
    </div>
    <?php
    $query = "SELECT * FROM song WHERE userID = '$this_profile->userID' ORDER BY songID DESC ";
    $result = mysql_query($query, $db_connect) or die ("Error in query: $query");
    $num_row = mysql_num_rows($result);
    ?>
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
                    <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span
                            class="glyphicon glyphicon-remove"></span> Cancel
                    </button>
                    <button type="submit" id="del_track" class="btn btn-danger btn-default pull-right"><span
                            class="glyphicon glyphicon-remove"></span> Delete it!
                    </button>
                </div>

            </div>

        </div>
    </div>

    </body>
    <script>
        TrackList =
            [
                <?php

                define("PATH_MEDIA_FILES", "../../data/");
                $file = scandir(PATH_MEDIA_FILES . $this_profile->userID . "/");
                array_splice($file, 0, 2);
                $count = count($file);
                if ($num_row > 0) {
                while ($row = mysql_fetch_array($result)) {

                ?>
                {
                    url: "<?php echo PATH_MEDIA_FILES . $this_profile->userID . '/' . $row['name'] ?>",
                    songID: "<?php echo $row['songID'] ?>",
                    viewCount: "<?php echo $row['viewCount'] ?>",
                    likeCount: "<?php echo $row['likeCount'] ?>",
                    title: "<?php echo $row['songID'] . " - " . $row['title']; ?>",
                    year: "<?php echo !empty($row['artist']) ? $row['artist'] : '';
                        echo !empty($row['album']) ? " - " . $row['album'] : '';
                        echo ($row['year'] != 0) ? " - " . $row['year'] : ''; ?>",

                }
                <?php if ($row == $num_row) {
                echo "";
            } else {
                echo ",";
            }
                }
                } ?>
            ];

        //Make a player and display help
        //player([tracklist], [show waveform?], [show help?])
        tinyplayer(TrackList, false, true);

        $(document).ready(function () {
            $(".audio-link").each(function () {
                this.addEventListener("loadeddata", function (e) {
                    var viewCount = $(this).data("view-count");
                    var songID = $(this).data("song-id");
                    var result = updateSongPlayed(this, viewCount, songID);
                }, true);
            });

            function updateSongPlayed(selector, viewCount, songID) {
                var data = {
                    viewCount: viewCount,
                    songID: songID
                };
                $.ajax({
                    url: '../../controller/update_song_played_time_on_song_id.php',
                    data: {data: data},
                    dataType: 'json',
                    type: 'POST',
                    success: function (data) {
                        $(selector).siblings(".stat-wrapper").find(".view-count").text(data['result']);
                    }
                });
            }

            $(".user-action").on("click", function () {
                var followerID = $(this).data("user-id");
                var $thisButton = $(this);

                $.ajax({
                    url: '../../controller/follow.php',
                    data: {id: followerID},
                    type: 'POST',
                    success: function (result) {
                        if(result === "followed"){
//                            console.log("should be followed: " + result);
                            $thisButton.toggleClass("unfollow following");
                        }else if(result === "unfollowed"){
//                            console.log("should be unfollowed: " + result);
                            $thisButton.toggleClass("following unfollow");
                        } else console.log(result);
                    },
                    error: function () {
                        $('#info').html('<p>An error has occurred</p>');
                    }
                });
            });
        });
    </script>
    </html>
<?php
db_closeconnect($db_connect); ?>
<?php include_once '../layout/footer.php'; ?>