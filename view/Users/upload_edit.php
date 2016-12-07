<?php 
session_start();
include_once("../../controller/db_connection.php");
$u = isset($_SESSION['user']) ? unserialize($_SESSION['user']) :'';
if (!isset($_SESSION['user'])) {
	header("location: /soundcloud/view/login.php");
}
include_once '../layout/header.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>HTTV music – Music makes me</title>
	<meta name="author" content="ThaiVH" />	
	<meta name="description" content="soundcloud"/>
	<meta name="keyword" content="sound, cloud, music"/>
	<meta charset="utf-8"/>
	<link rel="icon"  href="/soundcloud/assets/ico/1.png"/>
</head>

<?php 
if (isset($_GET['tag'])) {
	$tag = json_decode($_GET['tag']);
	$title = (isset($tag->title)) ? $tag->title : '';
	$artist = (isset($tag->artist)) ? $tag->artist : '';
	$year = (isset($tag->year)) ? $tag->year : 0;
	$album = (isset($tag->album)) ? $tag->album : '';
	$genre = (isset($tag->genre)) ? $tag->genre : '';
}
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$db_connect = db_connect();
    $query = "SELECT * FROM song WHERE songID ='$id' ";
    $result = mysql_query($query,$db_connect)or die ("Error in query: $query");
    $row = mysql_fetch_object($result);
    $title = (isset($row->title)) ? $row->title : '';
	$artist = (isset($row->artist)) ? $row->artist : '';
	$year = (isset($row->year)) ? $row->year : 0;
	$album = (isset($row->album)) ? $row->album : '';
	$genre = (isset($row->genre)) ? $row->genre : '';
	$name = (isset($row->name)) ? $row->name : '';
}
?>

<body>
	<div class="container">
		<h1>Edit</h1>
		<form method="POST" action="../../controller/check_edit_song.php" enctype="multipart/form-data">
			<div class="col span1"><h3>Tittle:</h3></div>
			<div class="col span2"><h3>
				<input type="text" required="required" name="title" value="<?php echo $title;  ?>"> 
			</h3></div>
			<br/>
			<div class="col span1"><h3>Artist:</h3></div>
			<div class="col span2"><h3>
				<input type="text" name="artist" value="<?php echo $artist;  ?>"> 
			</h3></div>
			<br/>
			<div class="col span1"><h3>Year:</h3></div>
			<div class="col span2"><h3>
				<input type="text" name="year" value="<?php echo $year;  ?>"> 
			</h3></div>
			<br/>
			<div class="col span1"><h3>Album:</h3></div>
			<div class="col span2"><h3>
				<input type="text" name="album" value="<?php echo $album;  ?>"> 
			</h3></div>
			<br/>
			<div class="col span1"><h3>Genre:</h3></div>
			<div class="col span2"><h3>
				<input type="text" name="genre" value="<?php echo $genre;  ?>"> 
			</h3></div>
			<br/>
			<div class="col span1"><h3>Image:</h3></div>
			<div class="col span2"><h3>
			<input type="file"  name="fileToUpload" id="fileToUpload">
			<br/>
			<br/>
			

			<input type="submit" class="btn" value="Submit" name="submit">
			<input type="hidden" name="name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : $row->name ; ?>" >
			<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
		</form>
	</div>
</body>

</html>
<?php include_once '../layout/footer.php'; ?>