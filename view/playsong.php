<?php
session_start();
include_once("../controller/db_connection.php");
include_once 'layout/header.php';
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
            <div class="action-bar-wrapper">
            ';

            $query = "SELECT * FROM likesong WHERE userID='$u->userID' and songID='$id'";
            $result = mysql_query($query, $db_connect) or die ("Error in query: $query");
            $num_row = mysql_num_rows($result);
            if ($num_row == 0) {
                echo '
                    <a class="button follow">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <span>Like</span>
                    </a>
                ';
            } else {
                echo '
                    <a class="button unfollow">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <span>Liked</span>
                    </a>
                ';
            }
            ?>
                <button type="button" class="btn button" id="Add_to_playlist">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add to playlist
                </button>
            </div>

        <?php

        }
        else
            echo "<br/>You have to log in to comment<br/>";
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
                define("PATH_MEDIA_FILES", "../data/");
                while ($row_song = mysql_fetch_array($result_song)) {

                ?>
                {
                    url: "<?php echo PATH_MEDIA_FILES . $row_song['userID'] . '/' . $row_song['name'] ?>",
                    songID: "<?php echo $row_song['songID'] ?>",
                    viewCount: "<?php echo $row_song['viewCount'] ?>",
                    likeCount: "<?php echo $row_song['likeCount'] ?>",
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
        tinyplayer(TrackList, false);

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

            $(".audio-link").bind("loadeddata", function () {
                var viewCount = $(this).data("view-count");
                var songID = $(this).data("song-id");
                updateSongPlayed(this, viewCount, songID);
            });

            function updateSongPlayed(selector, viewCount, songID) {
                var data = {
                    viewCount: viewCount,
                    songID: songID
                };
                $.ajax({
                    url: '../controller/update_song_played_time_on_song_id.php',
                    data: {data: data},
                    dataType: 'json',
                    type: 'POST',
                    success: function (data) {
                        $(selector).siblings(".stat-wrapper").find(".view-count").text(data['result']);
                    }
                });
            }

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


                        type: 'POST',
                        success: function (id) {
                            //location.reload();
                        },
                        error: function () {
                            $('#info').html('<p>An error has occurred</p>');
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

                        type: 'POST',
                        success: function (id) {
                            //location.reload();
                        },
                        error: function () {
                            $('#info').html('<p>An error has occurred</p>');
                        },
                    });
                    $(this).children("span").text("Unlike");
                    $(this).removeClass("follow");
                    $(this).addClass("unfollow");
                    $(this).unbind();
                    initiateFollow();
                });
            }
            $("#Add_to_playlist").click(function(ev){
                            //ev.preventDefault;
                            //$("#myModal").load(location.href + " #myModal");
                            $("#myModal").modal();

            });

            $("#select-playlist").on("change", function(){
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                $.ajax({
                    url: '../controller/check_song_in_playlist.php',
                    data: {pl_id: valueSelected, song_id:<?php echo $id;?>  },
                    type: 'POST',
                    success: function (check) {
                        if (check==1) {
                            $("#btn1").show();
                            $("#btn2").hide();
                        } else{
                            $("#btn2").show();
                            $("#btn1").hide();
                        }
                    },
                    error: function () {
                        $('#info').html('<p>An error has occurred</p>');
                    },
                });
                $("#btn1").on("click",function () {
                    console.log("cac");
                    $.ajax({
                        url: '../controller/add_song_to_playlist.php',
                        type: 'POST',
                        data: {pl_id: valueSelected, song_id:<?php echo $id;?>},
                        success: function (ok) {
                            //   alert("Success");
                            if ($(this).text()=="Add"){
                                // $(this).text("Remove");
                                // $(this).attr("id", "btn2");
                                $(this).children("span").text("Remove");
                            }
                            //$("#myModal").modal('toggle');
                            //$("#myModal").hide;
                        }
                    });

                });
                $("#btn2").on("click",function () {
                    $.ajax({
                        url: '../controller/remove_song_from_playlist.php',
                        type: 'POST',
                        data: {pl_id: valueSelected, song_id:<?php echo $id;?>},
                        success: function (ok) {
                            // alert("Success");
                                if ($(this).text()=="Remove"){
                               $(this).children("span").text("Add");
                                //$(this).attr("id", "btn1");
                            }
                             //$("#myModal").modal('toggle');
                              //$("#myModal").hide;
                        }
                    });
                });
            });
            $("#addpl").on("click",function () {
                // $.ajax({
                //     url: '../controller/create_playlist_from_song.php',
                //     type: 'POST',
                //     data: {pl_id: valueSelected, song_id:<?php echo $id;?>},
                //     success: function (ok) {
                //        // alert("Success");
                //     }
                // });
                $("#createModal").modal();
            });
            $("#crt").on("click",function (event){
                var inputtedPlaylistName = $( "#pl_name" ).val();
                console.log (inputtedPlaylistName );
                event.preventDefault();
                $.ajax({
                    url: '../controller/create_playlist_from_song.php',
                    type: 'POST',
                    data: {name: inputtedPlaylistName},
                    success: function (ok) {
                        alert("Success");
                        $("#createModal").modal('toggle');
                    }
                });
            });


        });

    </script>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add to playlist</h4>
                </div>
                <div class="modal-body">
                    <p>Please choose your playlist:</p>

                    Your playlist:
                    <select name="playlist" form="playlist-choose" id="select-playlist">
                        <option > Select your playlist </option>
                        <?php
                        $query_pl="SELECT * FROM playlist WHERE userID = '{$u->userID}'";
                        $result_pl = mysql_query($query_pl,$db_connect)or die ("Error in query: $query");
                        $num_row_pl = mysql_num_rows($result_pl);
                        if ($num_row_pl > 0)
                        {
                            while ($row_pl = mysql_fetch_array($result_pl))
                            {
                                ?>
                                <option value="<?php echo $row_pl['playlistID'];?>" ><?php echo $row_pl['name'];?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>


                </div>
                <div class="modal-footer">

                    <button style="display:none;" type="button" class="btn" id='btn1'  > Add to playlist </button>
                    <button style="display:none;" type="button" class="btn" id='btn2'  > Remove from playlist </button>
                    <button  type="button" class="btn btn-primary" id='addpl'  > Create a playlist </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="createModal" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create a playlist</h4>
                </div>
                <div class="modal-body">
                    Enter playlist's name:

                    <input type="text" id="pl_name" >




                </div>
                <div class="modal-footer">


                    <button type="button" class="btn btn-default" id="crt">Create</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>

        </div>
    </div>
</body>
</html>