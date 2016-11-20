<?php 
session_start();

if(isset($_SESSION['user']))
{
    $u = unserialize($_SESSION['user']);
}
include_once("db_connection.php");

	$email =isset($_POST['email']) ? $_POST['email']:'';
    $email = strip_tags($email);
    $pass = isset($_POST['pass']) ? $_POST['pass']:'';
    $pass = strip_tags($pass);
    $pass2 = isset($_POST['pass2']) ? $_POST['pass2']:'';
    $pass2 = strip_tags($pass2);
    $db_connect = db_connect();
if(!empty($email)&&!empty($pass)&&!empty($pass2))
{
	$query = "SELECT * FROM account WHERE email = '{$email}'";
    $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
    if(mysql_num_rows($result) == 0)
    {
            echo "  <script language=\"javascript\">
            alert(\"Account does not exist!\");
            </script>
            <script> window.location = \"../view/Users/delete.php \"; </script>
            ";   
    }
    else
    {
    	$object = mysql_fetch_object($result);
    	if ($object->email != $u->email)
    	{
    		echo "  <script language=\"javascript\">
            alert(\"Wrong email!\");
            </script>
            <script> window.location = \"../view/Users/delete.php \"; </script>
            ";
    	}
    	else
    	{
    		if ($pass != $pass2)
    		
    		{
    			echo "  <script language=\"javascript\">
	            alert(\"Your passwords do not match!\");
	            </script>
	            <script> window.location = \"../view/Users/delete.php \"; </script>
	            ";
	        }
	        else 
	        {
	        	 $query = "SELECT password, email FROM account WHERE password = '{$pass}' and email = '{$email}'";
    			 $result = mysql_query($query,$db_connect) or die ("Error in query: $query");
    			 if(mysql_num_rows($result) == 0)
    			 {
    			 	echo "  <script language=\"javascript\">
		            alert(\"Wrong password!\");
		            </script>
		            <script> window.location = \"../view/Users/delete.php \"; </script>
		            ";   
    			 }
    			 else
    			 {
    			 	$query = "DELETE FROM user WHERE email = '$email'";
    			 	$result = mysql_query($query,$db_connect) or die ("Error in query: $query");
    			 	$query = "DELETE FROM account WHERE email = '$email'";
    			 	$result = mysql_query($query,$db_connect) or die ("Error in query: $query");
    			 	echo "  <script language=\"javascript\">
		            alert(\"Success!\");
		            </script>
		            <script> window.location = \"logout.php \"; </script>
		            ";  
    			 }
	        }
	            
    	}
    }
}
?>