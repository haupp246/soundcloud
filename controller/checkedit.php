<?php
include_once("db_connection.php");
session_start();
if(isset($_SESSION['user']))
{
    $u = unserialize($_SESSION['user']);

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
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
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
//if (isset($_POST['edit']))
{
   
    $name = $_POST['name'];
    $name = htmlentities($name);
    $address = $_POST['address']; 
    $address = htmlentities($address);
    $gender = $_POST['gender']; 
    $gender = htmlentities($gender);
    $dob = $_POST['dob']; 
    $dob = htmlentities($dob);
    
    $bio = $_POST['bio']; 
    $bio = htmlentities($bio);
    $avatar =($target_file);
    $avatar = mysql_real_escape_string($avatar);
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
// else
// {
//     db_closeconnect($db_connect);
//     echo "  <script language=\"javascript\">
//                 alert(\"ban deo nhap cai loz j thi dang nhap cc \");
//             </script>
//             <script> window.location = \"../view/login.php \"; </script>
//             ";
// }
?>