<?php
session_start();
include_once("../controller/db_connection.php");
include_once 'layout/header.php';
$db_connect = db_connect();
$id = $_GET['id'];
$query = "SELECT * FROM song ORDER BY viewCount DESC,likeCount DESC LIMIT 10";
//$query = "SELECT * FROM song WHERE songID='$id'";
$result = mysql_query($query, $db_connect) or die ("Error in $query");
$num_row = mysql_num_rows($result);

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
         <h1> Top 10 song list<br/><br/></h1>
        <div id="all_tracks"></div>
        <?php
        if($num_row == 0){
        echo "Sorry this playlist does not contain any song!";
        //die();
        }
        else
        {

        ?>


    </div>
    <script>

        TrackList =
            [
                <?php
                if ($num_row > 0) {
                // should be only 1 song, if more then we have bug
                     define("PATH_MEDIA_FILES", "../data/");
                while ($row = mysql_fetch_array($result)) {
                ?>
                {
                    url: "<?php echo PATH_MEDIA_FILES . $row['userID'] . '/' . $row['name'] ?>",
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
        tinyplayer(TrackList, false);
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


    </body>
    </html>
<?php }db_closeconnect($db_connect); ?>
