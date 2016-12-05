<?php
session_start();
if (isset($_SESSION['user'])) header("location: view/Users/new_feed.php ");
function getTopTenTrack() {
    $gen_html = "";
    include_once("controller/db_connection.php");
    $db_connect = db_connect();
    $query = "SELECT songID, avatar, title, user.name as username FROM song 
              JOIN user on user.userID = song.userID
              ORDER BY viewCount DESC,likeCount DESC LIMIT 12";
    $result = mysql_query($query, $db_connect) or die ("Error in $query");
    $num_row = mysql_num_rows($result);
    while ($row = mysql_fetch_array($result)) {
        $gen_html .= '
            <div class="col-md-2 track-wrapper">
                <a href="/soundcloud/view/playsong.php?id=' . $row['songID'] . '">
                    <div class="trackCover" style="background-image:url(/soundcloud/assets/img/uploads/' . $row['avatar'] . ');"></div>
                    <div class="trackTitle trackInfo">' . $row['title'] . '</div>
                    <div class="trackUploader trackInfo">' . $row['username'] . '</div>
                </a>
            </div>
        ';
    }

    return $gen_html;
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
    <link rel="icon" href="/soundcloud/assets/ico/1.png"/>
    <link rel="stylesheet" type="text/css" href="/soundcloud/assets/css/bootstrap.css"/>
    <style type="text/css" media="screen">
        @import "/soundcloud/assets/css/custom.css";

        html {

        }
    </style>
    <script src="assets/js/jquery-3.1.1.js" type="text/javascript"></script>
    <script type="text/javascript">
        // code js
    </script>
    <noscript>Trình duyệt không hỗ trợ js</noscript>
</head>
<body>
<div class="cover-wrapper">
    <nav class="navbar">
        <div class="container nav">
            <a href="#">
                <img src="/soundcloud/assets/img/logo.png" height="70px" alt="" title="">
                <h2>HTTV music</h2>
            </a>
            <a href="/soundcloud/view/signup.php"><input type="button" class="btn" value="Join us now !"></a>
            <a href="/soundcloud/view/login.php"><input type="button" class="btn" value="Sign In"></a>
        </div>
    </nav>

    <div class="index">
        <h2 class="heroIntro">HTTV music - Find the music you love</h2>
        <form class="headerSearch form-group has-feedback" role="form" action="/soundcloud/view/search.php" method="GET"
              accept-charset="utf-8">
            <input id="search-box" class="form-control" type="text" name="search"
                   placeholder="Search for tracks, playlists, people" onkeyup="autocomplet() " autocomplete="off">
            <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
            <div class="input_container">
                <ul id="result"></ul>
            </div>
        </form>
    </div>
</div>

<div class="container chart">
    <h2>Here is what trending in our chart</h2>
    <?php echo getTopTenTrack() ?>

    <div class="clearfix"></div>
    <div class="col-xs-12" style="text-align: center; margin: 20px 0 40px;">
        <a href="/soundcloud/view/chart.php" class="action-chart">Explore our chart</a>
    </div>
</div>

<div class="pro">
    <div class="container">
        <h2 class="intro">You are producer? You create awesome audio?</h2>
        <p>Find out more about our <span class="gold">Premium HTTV</span> membership.</p>
        <a>Go pro</a>
    </div>
</div>
<?php include_once 'view/layout/footer.php'; ?>
<script>
    $(document).ready(function () {
        function autocomplet() {
            var min_length = 0; // min caracters to display the autocomplete
            var keyword = $('#search-box').val();
            if (keyword.length >= min_length) {
                $.ajax({
                    url: '/soundcloud/controller/test_search.php',
                    type: 'POST',
                    data: {keyword:keyword},
                    success:function(data){
                        $('#result').show();
                        $('#result').html(data);
                    }
                });
            } else {
                $('#result').hide();
            }
            $(document).click(function(e)
            {
                var $box = $('#result');
                if (e.target.id !== 'search-box' && e.target.id !== 'result' && !$.contains($box[0], e.target))
                    $("#result").hide();
            });

            $("#search-box").focusin(function(){
                $('#result').show();
            });
        }
    })
</script>

</body>
</html>