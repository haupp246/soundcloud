<?php

 function db_connect()
 {
$db_connect = mysql_connect("localhost","admin","1")
or die('Could not connect:');
 mysql_select_db('soundcloud', $db_connect) or die('Could not select database.');
return $db_connect;
}

function db_closeconnect($db_connect)
{
    mysql_close($db_connect);
}
?>