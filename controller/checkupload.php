<?php
include_once("db_connection.php");
session_start();

if(isset($_SESSION['user']))
{    $db_connect = db_connect();
    $title = isset($_POST['title'])? $_POST['title'] : '';
     $title = mysql_real_escape_string($title);
    $u = unserialize($_SESSION['user']);
    define("PATH_MEDIA_FILES", "/soundcloud/data/");
    if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"]) ) {
        $query="SELECT * FROM user WHERE userID='$u->userID'";
        $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
        $row=mysql_fetch_array($result);
        if ($row['ispro'] ==0 && $row['uploaded']>50)
        {
            echo "  <script>
                        alert(\"You have reach your upload limit! Please go pro to upload more.\");
                        window.location = \"/soundcloud/view/Users/upload.php \";
                    </script>
            ";
        }
        else
        {
        $target_dir = "../data/".$u->userID."/";
        $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
        $name = basename($_FILES["fileToUpload"]["name"]);
         $name = mysql_real_escape_string($name);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Allow certain file formats
        if($imageFileType != "mp3"  && $imageFileType != "wav" ) {
            echo "
            <script language=\"javascript\">
                alert(\"Sorry, only MP3, WAV files are allowed! Please try again! \");
            </script>
            <script> window.location = \"/soundcloud/view/Users/upload.php \"; </script>";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } 
        else 
        {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //$db_connect = db_connect();
                $query = "UPDATE user SET uploaded=uploaded +1 where userID='$u->userID' ";
                $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
                $name2 = substr($name,0,strlen($name)-4);
                $query = "INSERT INTO song (title, name, uploadTime, userID) VALUES ('$name2','$name', NOW(), '$u->userID')";
                $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
                $query = "SELECT songID, uploadTime FROM song WHERE songID= (SELECT max(songID) FROM song)";
                $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
                $row=mysql_fetch_array($result);
                $sid=$row['songID'];
                $time=$row['uploadTime'];
                $query = "INSERT INTO action (userID, songID, time) VALUES ('$u->userID','$sid','$time')";
                $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
                db_closeconnect($db_connect);  
                echo "
                <script language=\"javascript\">
                    alert(\"Success\");
                </script>
                <script> window.location = \"/soundcloud/controller/id3.php?tar=$target_file&title=$title&name=$name\"; </script>";
            } else {
                echo "  <script language=\"javascript\">
                    alert(\"Sorry, there was an error uploading your file! Please try again!\");
                    </script>
                    <script> window.location = \"/soundcloud/view/Users/upload.php \"; </script>";
            }
        }
}
}
}
?>