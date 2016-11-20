<?php
session_start();
if (isset($_SESSION['user'])) {
    $u = unserialize($_SESSION['user']);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>User index</title>
        <link rel="stylesheet" type="text/css" href="/soundcloud/lib/tiny/tinyplayer.css">
        <script src="/soundcloud/lib/tiny/tinyplayer.js"></script>
    </head>
    <body>
    <?php include_once '../layout/header.php'; ?>
    <div class="container">
        <?php
        $name = empty($u->name) ? $u->email : $u->name;
        echo "Hello ", $name, "</br>";
        echo "Address: ", $u->address, "</br>";
        echo "DOB: ", $u->dob, "</br>";
        echo "Gender: ", $u->gender, "</br>";
        echo "Bio: ", $u->bio, "</br>";
        ?>
        Avatar:
        <?php

        $link = $u->avatar;
        ?>
        <img src="../../assets/img/uploads/<?php echo $link; ?>" height="200"/>
        <form method="POST" action="profile_edit.php">

            <input type="submit" value="Edit" name="edit">
        </form>

        <div id="all_tracks"></div>
    </div>

    <script>
        /* Tiny HTML5 Music Player by Themistokle Benetatos */
        TrackList =
            [
                {
                    url:'/soundcloud/data/1.mp3',
                    title:'What Have We Done',
                    year:'2007'
                },
                {
                    url:'/soundcloud/data/2.mp3',
                    title:'Right of Stupidity',
                    year:'2004'
                }
            ];

        //Make a player and display help
        //player([tracklist], [show waveform?], [show help?])
        tinyplayer(TrackList, false);
    </script>
    </body>
    </html>
<?php } ?>