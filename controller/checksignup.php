
<?php

include_once("db_connection.php");
define("PATH_MEDIA_FILES", "../data/");


    $email =isset($_POST['email']) ? $_POST['email']:'';
    $email = strip_tags($email);
    $name = isset($_POST['name']) ? $_POST['name']:'';
    $name = strip_tags($name);
    $pass = isset($_POST['pass']) ? $_POST['pass']:'';
    $pass = strip_tags($pass);
    $pass2 = isset($_POST['pass2']) ? $_POST['pass2']:'';
    $pass2 = strip_tags($pass2);
    $db_connect = db_connect();

if(!empty($email)&&!empty($name)&&!empty($pass)&&!empty($pass2))
{
    $query = "SELECT email FROM account WHERE email = '{$email}'";
    $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
    if(mysql_num_rows($result) == 1)
    {
            echo "  <script language=\"javascript\">
            alert(\"Email has already taken!\");
            </script>
            <script> window.location = \"../view/signup.php \"; </script>
            ";   
    }
    else
    {
        if ($pass!=$pass2)
        {
            echo "  <script language=\"javascript\">
            alert(\"Your passwords do not match. Please try again!\");
            </script>
            <script> window.location = \"../view/signup.php \"; </script>
            ";   
        }
        else
        {
        $query = "INSERT INTO account (email, password) VALUES ('{$email}','{$pass}')";
        $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
        $query = "INSERT INTO user (email, name) VALUES ('{$email}', '{$name}')";
        $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
        
        

        db_closeconnect($db_connect);  
        echo "  <script language=\"javascript\">
                    alert(\"Success!\");
                </script>
                <script> window.location = \"../view/login.php \"; </script>
                ";   

        }
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