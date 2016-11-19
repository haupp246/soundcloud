<?php
 session_start();
 ?>
<?php
include_once("db_connection.php");
if(isset($_POST['email'])&&isset($_POST['pass']))
{
    $email = $_POST['email'];
    $email = htmlentities($email);
    $pass = $_POST['pass']; 
    $pass = htmlentities($pass);

    $db_connect = db_connect();
    $query = "SELECT password, email FROM account WHERE password = '{$pass}' and email = '{$email}'";
    $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
    if(mysql_num_rows($result) == 1)
    {
       $query = "SELECT email FROM admin WHERE email = '{$email}'"; 
       $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
       if (mysql_num_rows($result) == 1) {
           echo 'thang lon admin'.$email;
       }
       else
       {
        $query = "SELECT * FROM user WHERE email='$email'";
        $result = mysql_query($query,$db_connect)or die ("Error in query: $query");
        $object = mysql_fetch_object($result);
        $_SESSION['user'] = serialize($object);
         db_closeconnect($db_connect);
         session_write_close();
        echo "   <script language=\"javascript\"></script>

        <script> window.location = \"../view/Users/index.php \"; </script>";
       }
    }
    else
    {   

        db_closeconnect($db_connect);
      
        echo " 	<script language=\"javascript\">
            	alert(\"Sai email hoặc mật khẩu\");
            </script>
            <script> window.location = \"../view/login.php \"; </script>
            ";
    }   
}
else
{
    db_closeconnect($db_connect);
    echo "  <script language=\"javascript\">
                alert(\"ban deo nhap cai loz j thi dang nhap cc \");
            </script>
            <script> window.location = \"../view/login.php \"; </script>
            ";
}
?>