<?php
include_once("db_connection.php");
session_start();

    function target_name(){
        $u = unserialize($_SESSION['user']);
        $id = isset($_POST['id']) ? $_POST['id'] : '' ;
        $id = mysql_real_escape_string($id);
        if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"]) ) {
            $target_dir = "../assets/img/song/";
            $target_file = $target_dir .$id. basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        //     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        //     if($check !== false) {
        //         $uploadOk = 1;
        //     } else {
               
        //         $uploadOk = 0;
        //     }
        // }// Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                echo "  <script language=\"javascript\">
                    alert(\"Sorry, only JPG, JPEG, PNG & GIF files are allowed\");
                </script>
                
                ";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    return $id . basename($_FILES["fileToUpload"]["name"]);
                } else {
                    return null;
                }
            }
        }
    }
if(isset($_SESSION['user']))
{     $db_connect = db_connect();
    if (isset($_POST['submit'])) {
        $id = isset($_POST['id']) ? $_POST['id'] : '' ;
        $id = mysql_real_escape_string($id);
        $title = isset($_POST['title']) ? $_POST['title'] : '' ;
        $title = mysql_real_escape_string($title);
        $artist = isset($_POST['artist']) ?  $_POST['artist'] : '' ;
        $artist = mysql_real_escape_string($artist);
        $year = isset($_POST['year']) ?  $_POST['year'] : 0 ;
        $album = isset($_POST['album']) ? $_POST['album'] : '' ;
        $album = mysql_real_escape_string($album);
        $genre = isset($_POST['genre']) ? $_POST['genre'] : '' ;
        $name = $_POST['name'];
        $name = mysql_real_escape_string($name);
        $image   = target_name();
        $image   = isset($image) ? $image : $id."image" ;
        $query = "UPDATE song SET title='$title',artist='$artist',year=$year,genre='$genre',album='$album',image='$image' WHERE songid = '$id'";
        $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
        db_closeconnect($db_connect);  
        header("location: /soundcloud/view/Users/index.php");
    }
}
?>