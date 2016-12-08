<?php
session_start();
include_once '../controller/db_connection.php';

if (isset($_POST['submit'])){
//	echo "ahihi";
	$db_connect = db_connect();
	$email = isset($_POST['email']) ? $_POST['email'] :'' ;
	$name = isset($_POST['name']) ? $_POST['name'] :'' ;
	$cfkey = isset($_POST['cfkey']) ? $_POST['cfkey'] : '';
	$query = "SELECT * FROM account WHERE email = '{$email}' AND confirm_key = '{$cfkey}'";
	$result = mysql_query($query,$db_connect) or die ("Error in query: $query");
	$num_row= mysql_num_rows($result);
	if($num_row > 0) {
		$query = "UPDATE account SET confirmed = 1 WHERE email = '{$email}'";
		$result = mysql_query($query,$db_connect) or die ("Error in query: $query");
		$query = "INSERT INTO user (email, name) VALUES ('{$email}', '{$name}')";
		$result = mysql_query($query,$db_connect) or die ("Error in query: $query");
		db_closeconnect($db_connect);
		echo "  <script language=\"javascript\">
                    alert(\"Success !\");
                </script>
                <script> window.location = \"/soundcloud/view/login.php\"; </script>
                ";
	}
	else{
		db_closeconnect($db_connect);
		echo "  <script language=\"javascript\">
                    alert(\"The confirm key does not match! Please try again!\");
                </script>
                <script> window.location = \"/soundcloud/view/confirm.php?email={$email}&name={$name}\"; </script>
                ";
	}

}
?>