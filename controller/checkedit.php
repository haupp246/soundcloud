<?php
include_once("db_connection.php");
session_start();
if(isset($_SESSION['user']))
{
    $u = unserialize($_SESSION['user']);
    function target_name(){
        $u = unserialize($_SESSION['user']);
        if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"]) ) {
            $target_dir = "../assets/img/uploads/";
            $target_file = $target_dir .$u->userID. basename($_FILES["fileToUpload"]["name"]);
        //     $uploadOk = 1;
        //     $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
        //     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        //     if($check !== false) {
        //         $uploadOk = 1;
        //     } else {
               
        //         $uploadOk = 0;
        //     }
        // }
        // if ($uploadOk == 0) {
        // } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                return $u->userID . basename($_FILES["fileToUpload"]["name"]);
            } else {
                return null;
            }
        }
    }
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
        $bio        = strip_tags($bio);
        $ava_name   = target_name();
        $avatar     = isset($ava_name) ? $ava_name : $u->avatar ;

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
                    alert(\"Success\");
                </script>
                <script> window.location = \"../view/Users/index.php \"; </script>
                ";

    }

     
}
?>