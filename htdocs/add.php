<html>
<head><link rel="stylesheet" href="styles.css"></head>
<body>
<div class = "tab">
<p><a href = "index.php">Home</a></p>
<p><a href = "artists.php">Artists</a></p>
<p><a href = "albums.php">Albums</a></p>
</div>
<?php
include 'db.php';
include 'select.php';
if(isset($_GET['edited']) && $_GET['edited'] === '1')
{
	addInformation($conn, $_GET['edit_artist_id'], $_GET['edit_album_id'], $_GET['edit_album_title'], $_GET['edit_album_price'], $_GET['edit_album_genre'], $_GET['edit_album_num_tracks'], $_GET['edit_artist_name']);
}
else
{
	showAddableSelection($conn);
}
?>
<script src="scripts.js"></script>
</body></html>