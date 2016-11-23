<?php
session_start();
include_once("../../controller/db_connection.php");
if (!isset($_SESSION['user'])) {
  header("location: ../login.php");
}
if(isset($_SESSION['user']))
{
    $u = unserialize($_SESSION['user']);
    
    $name = empty($u->name) ? $u->email : $u->name;
?>

<?php 
  $db_connect = db_connect(); 
    $query = "SELECT * FROM song WHERE userID = '$u->userID' ";
    $result = mysql_query($query,$db_connect)or die ("Error in query: $query");
    $num_row = mysql_num_rows($result);
    
    // $arr = mysql_fetch_array($result);
    

?>

<?php 

      		define("PATH_MEDIA_FILES", "../../data/");
			$file = scandir (PATH_MEDIA_FILES.$u->userID."/");
			array_splice($file, 0, 2);
			$count = count($file);
			// foreach ($file as $key => $value) {
			// 	$value2 = explode('.',$value);
      echo "<pre>";
			if ($num_row > 0) {
	    		while ($row = mysql_fetch_array($result)) {
		    		
		?>
            {
                url: '<?php echo PATH_MEDIA_FILES.$u->userID.'/'.$row['name'] ?>',
                title:'<?php echo $row['title']; ?>',
                year:'<?php echo $row['year']; ?>',
                
            }
        <?php if ($row == $num_row)
        	{ echo "";}
        	else {echo ",";}
          }
          } ?>
          <?php } ?>