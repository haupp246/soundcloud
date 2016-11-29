<?php
session_start();
include_once("../controller/db_connection.php");
$db_connect = db_connect();
$id = $_GET['id'];
$query = "SELECT * FROM song NATURAL JOIN songinplaylist WHERE playlistID=$id";
//$query = "SELECT * FROM song WHERE songID='$id'";
$result = mysql_query($query, $db_connect) or die ("Error in $query");
$num_row = mysql_num_rows($result);
if($num_row == 0){
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
                <div class="write-comment form-group" data-user-id="' . $u->userID . '" data-playlist-id="' . $_GET['id'] . '">
                    <input id="write-comment-body" type="text" class="form-control" placeholder="Write a comment">
                <br/>
                </div>
            ';
        }
        else echo "<br/>You have to log in to comment<br/>";
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
                if ($num_row > 0) {
                // should be only 1 song, if more then we have bug
                     define("PATH_MEDIA_FILES", "../data/");
                while ($row = mysql_fetch_array($result)) {
                //define("PATH_MEDIA_FILES", "../data/");
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
            getUploaderInfoOnPlaylistID();
            getCommentsOnPlaylistID();

            function getUploaderInfoOnPlaylistID() {
                var playlistID = <?php echo $_GET['id']?>;
                $.ajax({
                    url: '../controller/get_uploader_info_on_playlist_id.php',
                    data: {playlistID: playlistID},
                    dataType: 'text',
                    type: 'POST',
                    success: function (data) {
//                        console.log("done get uploader info");
                        $(".uploader").html(data);
                    }
                });
            }

            function getCommentsOnPlaylistID() {
                var playlistID = <?php echo $_GET['id']?>;
                $.ajax({
                    url: '../controller/playlist_get_comment_on_playlist_id.php',
                    data: {playlistID: playlistID},
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
                    var playlistID = $(".write-comment").data("playlist-id");
                    var content = $(this).val();
                    console.log(userID + " " + playlistID + " " + content);
                    if (content == "")
                        return false;
                    var data = {
                        userID: userID,
                        playlistID: playlistID,
                        content: content
                    };
                    $.ajax({
                        url: '../controller/add_comment_on_playlist_id.php',
                        data: {data: data},
                        dataType: 'text',
                        type: 'POST',
                        success: function (data) {
                            $('#write-comment-body').val("");
                            console.log(data);
                            getCommentsOnPlaylistID();
                        }
                    });
                    return false;
                }
            });
        });
    </script>
    <!-- Modal -->
    <script type="text/javascript">
        $(function(){
            initiateFollow();
        });

        function initiateFollow() {
            $("a.unfollow").bind("mouseover",function(){
                //$(this).children("img").attr("src","/soundcloud/assets/img/follow.png");
                $(this).children("span").text("Unlike");
            });

            $("a.unfollow").bind("mouseout",function(){
                //$(this).children("img").attr("src","/soundcloud/assets/img/following.png");
                $(this).children("span").text("Liked");
            });

            $("a.unfollow").bind("click",function(){
                $.ajax({
                    url: '../controller/like.php',
                    data: {id: <?php echo $_GET['id'];?>},
                    error: function() {
                        $('#info').html('<p>An error has occurred</p>');
                    },

                    type: 'POST' ,
                    success: function(id){
                        //location.reload();
                    }});
                $(this).children("a.unfollow span").text("Like");
                $(this).removeClass("unfollow");
                $(this).addClass("follow");
                $(this).unbind();
                initiateFollow();
            });

            $("a.follow").bind("click",function(){
                //$(this).children("img").attr("src","/soundcloud/assets/img/follow.png");
                $.ajax({
                    url: '../controller/like.php',
                    data: {id: <?php echo $_GET['id'];?>},
                    error: function() {
                        $('#info').html('<p>An error has occurred</p>');
                    },
                    type: 'POST' ,
                    success: function(id){
                        //location.reload();
                    }});
                $(this).children("span").text("Unlike");
                $(this).removeClass("follow");
                $(this).addClass("unfollow");
                $(this).unbind();
                initiateFollow();
            });
        }
    </script>
    <style type="text/css" media="screen">
        a.button {
            text-align: center;
            background-origin: padding-box;
            background-size: auto;
            border-bottom-left-radius: 3px;
            border-bottom-right-radius: 3px;
            border-bottom-style: solid;
            border-bottom-width: 1px;
            border-left-style: solid;
            border-left-width: 1px;
            border-right-style: solid;
            border-right-width: 1px;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            border-top-style: solid;
            border-top-width: 1px;
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 20px;
            font-style: normal;
            font-variant: normal;
            font-weight: bold;
            line-height: 23px;
            outline-color: rgb(255, 255, 255);
            outline-style: none;
            outline-width: 0px;
            text-decoration: none;
            text-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 0px;
            vertical-align: middle;
            padding: 15px 30px 15px 30px;
            zoom: 1;
            width: 180px;
        }

        a.follow {
            background-image: linear-gradient(rgb(0, 150, 255), rgb(0, 93, 255));
            color: rgb(255, 255, 255);
            border-bottom-color: rgb(0, 113, 224);
            border-left-color: rgb(0, 113, 224);
            border-right-color: rgb(0, 113, 224);
            border-top-color: rgb(0, 113, 224);
        }

        a.follow:hover,a.follow:active {
            background: linear-gradient(#008aea, #024dcf);
            border-color: #0055a7;
        }

/*        a img {
            width: 14px;
            margin-right: 3px;
        }
*/
        a.unfollow {
            color: #FFFFFF;
            background: #3eef1f;
            background: -webkit-gradient(linear, 0% 40%, 0% 70%, from(#3eef1f),
            to(#35cc1a));
            background: -moz-linear-gradient(linear, 0% 40%, 0% 70%, from(#3eef1f),
            to(#35cc1a));
            border-bottom-color: #dcdcdc;
            border-left-color: #dcdcdc;
            border-right-color: #dcdcdc;
            border-top-color: #dcdcdc;
        }

        a.unfollow:hover,a.unfollow:active {
            background: linear-gradient(#eb3845, #d9030a);
            border-color: #e7473c;
            color: #fff;
        }
    </style>


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