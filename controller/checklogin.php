<?php
session_start();
?>
<?php
include_once("db_connection.php");
$email =isset($_POST['email']) ? $_POST['email']:'';
$email = strip_tags($email);
$pass = isset($_POST['pass']) ? $_POST['pass']:'';
$pass = strip_tags($pass);
if(!empty($email)&&!empty($pass))
{

	$db_connect = db_connect();
	$query = "SELECT * FROM account WHERE password = '{$pass}' and email = '{$email}'";
	$result = mysql_query($query,$db_connect) or die ("Error in query: $query");
	if(mysql_num_rows($result) == 1)
	{
		while ($row = mysql_fetch_assoc($result)){
			$check = $row['confirmed'];
			$name = $row['name'];
		}
		$query = "SELECT email FROM admin WHERE email = '{$email}'";
		$result = mysql_query($query,$db_connect) or die ("Error in query: $query");
		if (mysql_num_rows($result) == 1) {
			header("location:../view/Admin/index.php");
		}
		else
		{
			if ($check ==1)
			{
				$query = "SELECT * FROM user WHERE email='$email'";
				$result = mysql_query($query, $db_connect) or die ("Error in query: $query");
				$object = mysql_fetch_object($result);
				$_SESSION['user'] = serialize($object);
				//tao thu muc user
				$query = "SELECT * FROM user WHERE email='$email'";
				$result = mysql_query($query, $db_connect) or die ("Error in query: $query");
				$object = mysql_fetch_object($result);
				if (!is_dir("../data/" . $object->userID . '/'))
				{
					mkdir("../data/" . $object->userID . '/', 777);
				}


				db_closeconnect($db_connect);
				session_write_close();
				echo "   <script language=\"javascript\"></script>
        <script> window.location = \"../view/Users/index.php \"; </script>";
			}
			else
			{
				db_closeconnect($db_connect);
				echo " 	<script language=\"javascript\">
            	alert(\"Please validate your account first!\");
            </script>
            <script> window.location = \"/soundcloud/view/confirm.php?email={$email}&name={$name}\"; </script>
            ";
			}
		}
	}
	else
	{
		db_closeconnect($db_connect);
		echo " 	<script language=\"javascript\">
            	alert(\"Wrong email or password!\");
            </script>
            <script> window.location = \"../view/login.php \"; </script>
            ";
	}
}
else
{
	//db_closeconnect($db_connect);
	echo "  <script language=\"javascript\">
                alert(\"Please fill in email and password!\");
            </script>
            <script> window.location = \"../view/login.php \"; </script>
            ";
}
?>