<?php
session_start();
include_once("../controller/db_connection.php");
$db_connect = db_connect();
$id = $_GET['id'];
$query = "SELECT * FROM song WHERE songID='$id'";
$result_song = mysql_query($query, $db_connect) or die ("Error in $query");
$num_row_song = mysql_num_rows($result_song);
if ($num_row_song == 0) {
    echo "Sorry this song not exist in our system!";
    die();
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
        <link rel="stylesheet" type="text/css" href="/soundcloud/lib/font-awesome-4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
        <link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/playsong.css">

        <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
    </head>
    <body>
    <?php include_once 'layout/header.php'; ?>
    <div class="container">
        <div id="all_tracks"></div>
        <?php
        if (isset($_SESSION['user'])) {
            $u = unserialize($_SESSION['user']);
            $name = empty($u->name) ? $u->email : $u->name;
            echo '
                <div class="write-comment form-group" data-user-id="' . $u->userID . '" data-song-id="' . $_GET['id'] . '">
                    <input id="write-comment-body" type="text" class="form-control" placeholder="Write a comment">
                </div>
            ';
        }

        $query = "SELECT * FROM likesong WHERE userID='$u->userID' and songID='$id'";
        $result = mysql_query($query, $db_connect) or die ("Error in query: $query");
        $num_row = mysql_num_rows($result);
        if ($num_row == 0) {
            echo '
                <div class="action-bar-wrapper">
                    <a class="button follow">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <span>Like</span>
                    </a>
                </div>
            ';
        } else {
            echo '
                <div class="action-bar-wrapper">
                    <a class="button unfollow">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <span>Liked</span>
                    </a>
                </div>';
        }

        ?>
        <div id="comments">
            <div class="uploader">
            </div>
            <div class="comment-wrapper">
            </div>
        </div>
    </div>
    <script>
        TrackList =
            [
                <?php
                if ($num_row_song > 0) {
                // should be only 1 song, if more then we have bug
                while ($row_song = mysql_fetch_array($result_song)) {
                define("PATH_MEDIA_FILES", "../data/");
                $file = scandir(PATH_MEDIA_FILES . $row_song['userID'] . "/");
                array_splice($file, 0, 2);
                ?>
                {
                    url: "<?php echo PATH_MEDIA_FILES . $row_song['userID'] . '/' . $row_song['name'] ?>",
                    title: "<?php echo $row_song['songID'] . " - " . $row_song['title']; ?>",
                    year: "<?php echo !empty($row_song['artist']) ? $row_song['artist'] : '';
                        echo !empty($row_song['album']) ? " - " . $row_song['album'] : '';
                        echo ($row_song['year'] != 0) ? " - " . $row_song['year'] : ''; ?>",
                }
                <?php if ($row_song == $num_row_song) {
                echo "";
            } else {
                echo ",";
            }
                }
                } ?>
            ];
        tinyplayer(TrackList, false, true);

        $(document).ready(function () {
            getUploaderInfoOnSongID();
            getCommentsOnSongID();

            function getUploaderInfoOnSongID() {
                var songID = <?php echo $_GET['id']?>;
                $.ajax({
                    url: '../controller/get_uploader_info_on_song_id.php',
                    data: {songID: songID},
                    dataType: 'text',
                    type: 'POST',
                    success: function (data) {
//                        console.log("done get uploader info");
                        $(".uploader").html(data);
                    }
                });
            }

            function getCommentsOnSongID() {
                var songID = <?php echo $_GET['id']?>;
                $.ajax({
                    url: '../controller/song_get_comment_on_song_id.php',
                    data: {songID: songID},
                    dataType: 'text',
                    type: 'POST',
                    success: function (data) {
//                        console.log("done get comments");
                        $(".comment-wrapper").html(data);
                    }
                });
            }

            $('#write-comment-body').keypress(function (e) {
                if (e.which == 13) {
                    var userID = $(".write-comment").data("user-id");
                    var songID = $(".write-comment").data("song-id");
                    var content = $(this).val();
                    if (content == "")
                        return false;
                    var data = {
                        userID: userID,
                        songID: songID,
                        content: content
                    };
                    $.ajax({
                        url: '../controller/add_comment_on_song_id.php',
                        data: {data: data},
                        dataType: 'text',
                        type: 'POST',
                        success: function (data) {
                            $('#write-comment-body').val("");
                            console.log(data);
                            getCommentsOnSongID();
                        }
                    });
                    return false;
                }
            });
        });
    </script>
    <!-- Modal -->
    <script type="text/javascript">
        $(function () {
            initiateFollow();
        });

        function initiateFollow() {
            $("a.unfollow").bind("mouseover", function () {
                //$(this).children("img").attr("src","/soundcloud/assets/img/follow.png");
                $(this).children("span").text("Unlike");
            });

            $("a.unfollow").bind("mouseout", function () {
                //$(this).children("img").attr("src","/soundcloud/assets/img/following.png");
                $(this).children("span").text("Liked");
            });

            $("a.unfollow").bind("click", function () {
                $.ajax({
                    url: '../controller/like.php',
                    data: {id: <?php echo $_GET['id'];?>},
                    error: function () {
                        $('#info').html('<p>An error has occurred</p>');
                    },

                    type: 'POST',
                    success: function (id) {
                        //location.reload();
                    }
                });
                $(this).children("a.unfollow span").text("Like");
                $(this).removeClass("unfollow");
                $(this).addClass("follow");
                $(this).unbind();
                initiateFollow();
            });

            $("a.follow").bind("click", function () {
                //$(this).children("img").attr("src","/soundcloud/assets/img/follow.png");
                $.ajax({
                    url: '../controller/like.php',
                    data: {id: <?php echo $_GET['id'];?>},
                    error: function () {
                        $('#info').html('<p>An error has occurred</p>');
                    },
                    type: 'POST',
                    success: function (id) {
                        //location.reload();
                    }
                });
                $(this).children("span").text("Unlike");
                $(this).removeClass("follow");
                $(this).addClass("unfollow");
                $(this).unbind();
                initiateFollow();
            });
        }
    </script>

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
    <br><br>
    <!--    <a  class="button follow"><img width="10px" /> <span>Like</span></a>-->
    <!--    <a  class="button unfollow"><img width="10px" /> <span>Following</span></a>-->
    </body>
    </html>
<?php db_closeconnect($db_connect); ?>
<?php include_once 'layout/footer.php'; ?>