<?php
session_start();
include_once '../controller/db_connection.php';
if (isset($_SESSION['user'])) {
	header("location: Users/");
}
$email = isset($_GET['email']) ? $_GET['email'] :'' ;
$name = isset($_GET['name']) ? $_GET['name'] :'' ;
$db_connect = db_connect();
$query = "SELECT * FROM account WHERE email = '{$email}'";
$result = mysql_query($query,$db_connect) or die ("Error in query: $query");
$num_row= mysql_num_rows($result);
if($num_row > 0)
{
	while ($row = mysql_fetch_assoc($result))
	{
		if ($row['confirmed'] == 1)
		{
			header("location: Users/");
		}
		else
		{
			?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>HTTV music – Music makes me</title>
                <meta name="author" content="ThaiVH"/>
                <meta name="description" content="soundcloud"/>
                <meta name="keyword" content="sound, cloud, music"/>
                <meta charset="utf-8"/>
                <link rel="icon" href="/soundcloud/assets/ico/1.png"/>
                <style type="text/css">
                    .btnn[value='Sign In'] {
                        visibility: hidden;
                    }

                    .social > li > a {
                        margin-top: 9px;
                    }
                </style>
            </head>

            <body>
			<?php include_once 'layout/header.php'; ?>
            <div class="container">
                <div class="container2">
                    <h1>Confirm</h1>
                    <form method="POST" action="/soundcloud/controller/confirm.php">
                        <label><h3>Email: </h3></label>
                        <br/>
                        <input type="email" disabled value="<?php echo $email; ?>" placeholder="abcd1234@zxy.abc">
                        <br/> <br/>
                        <input type="hidden" name="email" value="<?php echo $email; ?>">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <label><h3>Confirm key</h3></label>
                        <br/>
                        <input type="text" name="cfkey" required="required" maxlength="8" placeholder="12345678">
                        <br/>
                        <br/>
                        <input type="submit" class="btn" required="required" name="submit" value="Login">
                    </form>
                </div>
            </div>
            </body>
            </html>
			<?php
		}
	}
}
else
{
    header("location: login.php");
}
?>