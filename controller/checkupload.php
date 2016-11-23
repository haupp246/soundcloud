<?php
include_once("db_connection.php");
session_start();

if(isset($_SESSION['user']))
{
    $name = isset($_POST['name'])? $_POST['name'] : '';
    $u = unserialize($_SESSION['user']);
    define("PATH_MEDIA_FILES", "/soundcloud/data/");
    if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"]) ) {
        $target_dir = "../data/".$u->userID."/";
        $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Allow certain file formats
        if($imageFileType != "mp3" && $imageFileType != "wav") {
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
                $db_connect = db_connect();
                $query = "INSERT INTO song (name, userID) VALUES ('$name','$u->userID')";
                $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
                db_closeconnect($db_connect);  
                echo "
                <script language=\"javascript\">
                    alert(\"Success\");
                </script>
                <script> window.location = \"/soundcloud/controller/id3.php?tar=$target_file&name=$name\"; </script>";
            } else {
                echo "  <script language=\"javascript\">
                    alert(\"Sorry, there was an error uploading your file! Please try again!\");
                    </script>
                    <script> window.location = \"/soundcloud/view/Users/upload.php \"; </script>";
            }
        }
}
}
?>