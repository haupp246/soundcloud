<?php 
session_start();
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
	<link rel="icon"  href="/soundcloud/assets/ico/1.ico"/>			
</head>

<?php 
$tag = json_decode($_GET['tag']);
$title = (isset($tag->title)) ? $tag->title : '';
$artist = (isset($tag->artist)) ? $tag->artist : '';
$year = (isset($tag->year)) ? $tag->year : 0;
$album = (isset($tag->album)) ? $tag->album : '';
$genre = (isset($tag->genre)) ? $tag->genre : '';
?>

<body>
	<div class="container">
		<h1>Edit</h1>
		<form method="POST" action="../../controller/check_edit_song.php" enctype="multipart/form-data">
			<div class="col span1"><h3>Tittle:</h3></div>
			<div class="col span2"><h3>
				<input type="text" name="title" value="<?php echo $title;  ?>"> 
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
			

			<input type="submit" class="btn" value="Submit" name="submit">
			<input type="hidden" name="name" value="<?php echo $_GET['name']; ?>" >
		</form>
	</div>
</body>

</html>
<?php include_once '../layout/footer.php'; ?>