<?php
include_once("db_connection_template.php");
if(isset($_POST['email'])&&isset($_POST['pass'])&&isset($_POST['pass2']))
{
    $email = $_POST['email'];
    $email = htmlentities($email);
    $name = $_POST['name'];
    $name = htmlentities($name);
    $pass = $_POST['pass']; 
    $pass = htmlentities($pass);
    $pass2 = $_POST['pass2']; 
    $pass2 = htmlentities($pass2);
    $db_connect = db_connect(); 
    $query = "INSERT INTO account (email, password) VALUES ('{$email}','{$pass}')";
    $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
    $query = "INSERT INTO user (email, name) VALUES ('{$email}', '{$name}')";
    $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
   

     
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