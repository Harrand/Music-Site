<html>
<head><link rel="stylesheet" href="styles.css"></head>
<body>
<div class = "tab">
<p><a style = "color: #ffffff !important;" href = "index.php">Home</a></p>
<p><a href = "artists.php">Artists</a></p>
<p><a href = "albums.php">Albums</a></p>
</div>
<br>
<h1>Complete list of Artists and their CDs</h1>
<?php
include 'db.php';
include 'select.php';
selectAll($conn);
?>
<script src="scripts.js"></script>
</body></html>