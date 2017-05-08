<html>
<head><link rel="stylesheet" href="styles.css"></head>
<body>
<div class = "tab">
<p><a href = "index.php">Home</a></p>
<p><a href = "artists.php">Artists</a></p>
<p><a style = "color: #ffffff !important;" href = "albums.php">Albums</a></p>
</div>
<form class = "search_form" action="albums.php" onsubmit="return validateAlbumForm(this)">
<p>
<input type="text" name="search_album_name" placeholder="Album Name...">
<br>
<input type="text" name="search_album_id" placeholder="Album Id...">
<br>
<input type="text" name="search_album_price_min" placeholder="Minimum Price...">
<br>
<input type="text" name="search_album_price_max" placeholder="Maximum Price...">
<br>
<input type="text" name="search_album_genre" placeholder="Album Genre...">
<br>
<input type="submit" value="Search by Name or ID">
</p>
</form>
<div id = "table">
<?php
include 'db.php';
include 'select.php';
$hasName = isset($_GET['search_album_name']) && !empty($_GET['search_album_name']);
$hasId = isset($_GET['search_album_id']) && !empty($_GET['search_album_id']);
$hasMinPrice = isset($_GET['search_album_price_min']) && !empty($_GET['search_album_price_min']);
$hasMaxPrice = isset($_GET['search_album_price_max']) && !empty($_GET['search_album_price_max']);
$hasGenre = isset($_GET['search_album_genre']) && !empty($_GET['search_album_genre']);
if($hasName)
	$str = "cdTitle LIKE '" . $_GET['search_album_name'] . "'";
else if($hasId)
	$str = "cdId = " . $_GET['search_album_id'];
else
	$str = "True = True";
if($hasMinPrice)
	$str .= " AND cdPrice >= " . $_GET['search_album_price_min'];
if($hasMaxPrice)
	$str .= " AND cdPrice <= " . $_GET['search_album_price_max'];
if($hasGenre)
	$str .= " AND cdGenre LIKE '" . $_GET['search_album_genre'] . "'";
select($conn, "cd", $str, "", False);
?>
</div>
<script src="scripts.js"></script>
</body></html>