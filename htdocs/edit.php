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
if(isset($_GET['delete']) && $_GET['delete'] === '1')
{
	if(isset($_GET['edit_album_id']))
		deleteEntry($conn, "cd", $_GET['edit_artist_id'], $_GET['edit_album_id'], NULL);
	else if(isset($_GET['edit_artist_name']))
		deleteEntry($conn, "artist", $_GET['edit_artist_id'], NULL, $_GET['edit_artist_name']);
}
if(isset($_GET['edited']) && $_GET['edited'] === '1')
{
	updateInformation($conn, $_GET['edit_artist_id'], $_GET['edit_album_id'], $_GET['edit_album_title'], $_GET['edit_album_price'], $_GET['edit_album_genre'], $_GET['edit_album_num_tracks'], $_GET['edit_artist_name']);
}
if(isset($_GET['edit_artist_id']))
{
	if(isset($_GET['edit_album_id']))
		showEditableSelection($conn, "cd", "artId = " . $_GET['edit_artist_id'] . " AND cdId = " . $_GET['edit_album_id']);
	else if(isset($_GET['edit_artist_name']))
		showEditableSelection($conn, "artist", "artId = " . $_GET['edit_artist_id']);
}
else
	echo "<h1>Nothing to edit</h1>";
?>
<script src="scripts.js"></script>
</body></html>