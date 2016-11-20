<?php
include_once("db_connection.php");
session_start();
if(isset($_SESSION['user']))
{
    $u = unserialize($_SESSION['user']);
    $target_dir = "../assets/img/uploads/";
    $target_file = $target_dir .$u->userID . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])&&isset($_FILES["fileToUpload"]) ) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $target_name = $u->userID . basename($_FILES["fileToUpload"]["name"]);
        } else {
            $target_name = null;
        }
    }
    //if (isset($_POST['edit']))
    {
        $name       = isset($_POST['name']) ? $_POST['name']: null;
        $name       = strip_tags($name);
        $address    = isset($_POST['address']) ? $_POST['address']:null; 
        $address    = strip_tags($address);
        $gender     = isset($_POST['gender']) ? $_POST['gender']:null; 
        $gender     = htmlentities($gender);
        $dob        = isset($_POST['dob']) ? $_POST['dob']:null; 
        $dob        = htmlentities($dob);
        $bio        = isset($_POST['bio']) ? $_POST['bio']:null; 
        $bio      = strip_tags($bio);
        $avatar     = isset($target_name) ? $target_name : $u->avatar ;

        $db_connect = db_connect(); 
         
        $query = "UPDATE user SET name='$name',address='$address',gender='$gender',dob='$dob',bio='$bio',avatar='$avatar' WHERE userid = '$u->userID'";
        $result = mysql_query($query,$db_connect)or die ("Error in query: $query");
            
         $query = "SELECT * FROM user WHERE email='$u->email'";
            $result = mysql_query($query,$db_connect)or die ("Error in query: $query");
            $object = mysql_fetch_object($result);
            $_SESSION['user'] = serialize($object);
             db_closeconnect($db_connect);
             session_write_close();


        
            echo "  <script language=\"javascript\">
                    alert(\"Thanh cong\");
                </script>
                <script> window.location = \"../view/Users/index.php \"; </script>
                ";

    }

     
}
?>