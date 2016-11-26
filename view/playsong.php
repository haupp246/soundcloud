<?php
session_start();
include_once("../controller/db_connection.php");
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
        ?>
        <div id="comments">
            <div class="uploader">
            </div>
            <div class="comment-wrapper">
            </div>
        </div>
    </div>
    <?php
    $db_connect = db_connect();
    $id = $_GET['id'];
    $query = "SELECT * FROM song WHERE songID='$id'";
    $result = mysql_query($query, $db_connect) or die ("Error in $query");
    $num_row = mysql_num_rows($result);
    ?>
    <script>
        TrackList =
            [
                <?php
                if ($num_row > 0) {
                // should be only 1 song, if more then we have bug
                while ($row = mysql_fetch_array($result)) {
                define("PATH_MEDIA_FILES", "../data/");
                $file = scandir(PATH_MEDIA_FILES . $row['userID'] . "/");
                array_splice($file, 0, 2);
                ?>
                {
                    url: "<?php echo PATH_MEDIA_FILES . $row['userID'] . '/' . $row['name'] ?>",
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
    </html>
<?php db_closeconnect($db_connect); ?>
<?php include_once 'layout/footer.php'; ?>