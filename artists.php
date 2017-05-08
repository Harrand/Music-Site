<html>
<head><link rel="stylesheet" href="styles.css"></head>
<body>
<div class = "tab">
<p><a href = "index.php">Home</a></p>
<p><a style = "color: #ffffff !important;" href = "artists.php">Artists</a></p>
<p><a href = "albums.php">Albums</a></p>
</div>
<form class = "search_form" action="artists.php" onsubmit="return validateArtistForm(this)">
<p>
<input type="text" name="search_artist_name" placeholder="Artist Name...">
<br>
<input type="text" name="search_artist_id" placeholder="Artist Id...">
<br>
<input type="submit" value="Search by Name or ID">
</p>
</form>
<?php
include 'db.php';
include 'select.php';
$hasName = isset($_GET['search_artist_name']) && !empty($_GET['search_artist_name']);
$hasId = isset($_GET['search_artist_id']) && !empty($_GET['search_artist_id']);
if($hasName)
	selectArtistByName($conn, $_GET['search_artist_name']);
else if($hasId)
	selectArtistByID($conn, $_GET['search_artist_id']);
else
	select($conn, "artist", "True", "", False);
?>
<script src="scripts.js"></script>
</body></html>