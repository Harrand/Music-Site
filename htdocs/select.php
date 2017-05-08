<?php
function select($conn, $tables, $attribute, $toSelect, $selectIsString)
{
	if($selectIsString)
		$sql = "SELECT * FROM " . $tables . " WHERE " . $attribute . " '" . $toSelect . "'";
	else
		$sql = "SELECT * FROM " . $tables . " WHERE " . $attribute . $toSelect;
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	echo "<table id='selection' style='width:100%'><tr>";
	if($tables === "artist")
	{
		$stmt->bind_result($artId, $artName);
		echo "<th>Artist ID</th><th>Artist Name </th>";
	}
	else if($tables === "cd")
	{
		$stmt->bind_result($cdId, $artId, $cdTitle, $cdPrice, $cdGenre, $cdNumTracks);
		echo "<th>Artist ID</th><th>CD ID</th><th>CD Title</th><th>CD Price</th><th>CD Genre</th><th>CD Number of Tracks</th>";
	}
	else if(strpos($tables, "NATURAL JOIN") !== false)
	{
		$stmt->bind_result($artId, $cdId, $cdTitle, $cdPrice, $cdGenre, $cdNumTracks, $artName);
		echo "<th>Artist ID</th><th>CD ID</th><th>CD Title</th><th>CD Price</th><th>CD Genre</th><th>CD Number of Tracks</th><th>Artist Name</th>";
	}
	else
	{
		echo "<th></th></tr>";
		return;
	}
	echo "</tr>";
	while ($stmt->fetch())
	{
		echo "<tr>";
		if(isset($artId))
			echo "<td>" . htmlentities($artId) . "</td>";
		if(isset($cdId))
			echo "<td>" . htmlentities($cdId) . "</td>";
		if(isset($cdTitle))
			echo "<td>" . htmlentities($cdTitle) . "</td>";
		if(isset($cdPrice))
			echo "<td>" . htmlentities($cdPrice) . "</td>";
		if(isset($cdGenre))
			echo "<td>" . htmlentities($cdGenre) . "</td>";
		if(isset($cdNumTracks))
			echo "<td>" . htmlentities($cdNumTracks) . "</td>";
		else if(!isset($cdNumTracks) && ($tables === "cd" || strpos($tables, "NATURAL JOIN") !== false))
			echo "<td>0</td>";
		if(isset($artName))
		{
			echo "<td>" . htmlentities($artName) . "</td>";
			if(strpos($tables, "NATURAL JOIN") === false)
				echo "<td><a style='color:#cfcfcf !important;' href='" . "edit.php?edited=0&edit_artist_id=" . $artId . "&edit_artist_name=" . $artName . "'>Edit</a></td>";
		}
		else if(isset($cdId) && strpos($tables, "NATURAL JOIN") === false)
			echo "<td><a style='color:#cfcfcf !important;' href='" . "edit.php?edited=0&edit_artist_id=" . $artId . "&edit_album_id=" . $cdId . "'>Edit</a></td>";
		echo "</tr>";
	}
	echo "</table><br>";
	echo "<h1><a style='color: #cfcfcf;' href='add.php'>Add new entry</a></h1>";
}
function showAddableSelection($conn)
{
	$sql = "SELECT Max(artID) FROM artist";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($maxArtID);
	$stmt->fetch();
	$stmt->close();
	$sql = "SELECT Max(cdID) FROM cd";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($maxAlbumID);
	$stmt->fetch();
	$stmt->close();
	$maxArtID++;
	$maxAlbumID++;
	echo "<form class='edit_form' action = 'add.php' onsubmit='return validateEditForm(this)'><h1 style = 'display: block; text-align: left !important;'>";
	echo "<div style = 'width: 300px; margin-right: auto; margin-left: auto;'>";
		echo "<input type='hidden' name='edited' value='1'>";
		echo "Artist ID: <input type='text' name='edit_artist_id' value='" . $maxArtID . "'><br>";
		echo "Album ID: <input type='text' name='edit_album_id' value='" . $maxAlbumID . "'><br>";
		echo "Album Title: <input type='text' name='edit_album_title'><br>";
		echo "Album Price: <input type='text' name='edit_album_price'><br>";
		echo "Album Genre: <input type='text' name='edit_album_genre'><br>";
		echo "Album Number of Tracks: <input type='text' name='edit_album_num_tracks'><br>";
		echo "Artist Name: <input type='text' name='edit_artist_name'><br>";	
	echo "<br><input style = 'width: 272px;' type='submit' value='Submit Edits'>";
	echo "</div>";
	echo "</h1></form>";
}
function showEditableSelection($conn, $tables, $args)
{
	$sql = "SELECT * FROM " . $tables . " WHERE " . $args;
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	if($tables === "artist")
	{
		$stmt->bind_result($artId, $artName);
	}
	else if($tables === "cd")
	{
		$stmt->bind_result($cdId, $artId, $cdTitle, $cdPrice, $cdGenre, $cdNumTracks);
	}
	else if(strpos($tables, "NATURAL JOIN") !== false)
	{
		$stmt->bind_result($artId, $cdId, $cdTitle, $cdPrice, $cdGenre, $cdNumTracks, $artName);
	}
	echo "<form class='edit_form' action = 'edit.php' onsubmit='return validateEditForm(this)'><h1 style = 'display: block; text-align: left !important;'>";
	echo "<div style = 'width: 300px; margin-right: auto; margin-left: auto;'>";
	while($stmt->fetch())
	{
		echo "<input type='hidden' name='edited' value='1'>";
		if(isset($artId))
			echo "Artist ID: <input type='text' name='edit_artist_id' value='" . $artId . "'><br>";
		if(isset($cdId))
			echo "Album ID: <input type='text' name='edit_album_id' value='" . $cdId . "'><br>";
		if(isset($cdTitle))
			echo "Album Title: <input type='text' name='edit_album_title' value='" . $cdTitle . "'><br>";
		if(isset($cdPrice))
			echo "Album Price: <input type='text' name='edit_album_price' value='" . $cdPrice . "'><br>";
		if(isset($cdGenre))
			echo "Album Genre: <input type='text' name='edit_album_genre' value='" . $cdGenre . "'><br>";
		if(isset($cdNumTracks))
			echo "Album Number of Tracks: <input type='text' name='edit_album_num_tracks' value='" . $cdNumTracks . "'><br>";
		if(isset($artName))
			echo "Artist Name: <input type='text' name='edit_artist_name' value='" . $artName . "'><br>";
		echo "<input type='checkbox' name='delete' value='1'>Delete this entry <br>";
	}
	echo "<br><input style = 'width: 272px;' type='submit' value='Submit Edits'>";
	echo "</div>";
	echo "</h1></form>";
}
function selectAll($conn)
{
	select($conn, "cd NATURAL JOIN artist", "True", "", False);
}
function selectArtistByName($conn, $name)
{
	select($conn, "artist", "artName LIKE ", $name, True);
}
function selectArtistByID($conn, $id)
{
	select($conn, "artist", "artId = ", $id, False);
}
function selectAlbumByName($conn, $name)
{
	select($conn, "cd", "cdTitle LIKE ", $name, True);
}
function selectAlbumByID($conn, $id)
{
	select($conn, "cd", "cdId = ", $id, False);
}

function updateInformation($conn, $artId, $cdId, $cdTitle, $cdPrice, $cdGenre, $cdNumTracks, $artName)
{
	if(empty($cdNumTracks))
	{
		$cdNumTracks = 0;
	}
	if(isset($cdId))
	{
		$sql = "UPDATE `cd` SET `cdID` = ?, `artID` = ?, `cdTitle` = ?, `cdPrice` = ?, `cdGenre` = ?, `cdNumTracks` = ? WHERE `cdID` = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('iisdsii', $cdId, $artId, $cdTitle, $cdPrice, $cdGenre, $cdNumTracks, $cdId);
		$stmt->execute();
		$stmt->close();
	}
	else if(isset($artName))
	{
		$sql = "UPDATE `artist` SET `artID` = ?, `artName` = ? WHERE `artID` = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('isi', $artId, $artName, $artId);
		$stmt->execute();
		$stmt->close();
	}
}

function addInformation($conn, $artId, $cdId, $cdTitle, $cdPrice, $cdGenre, $cdNumTracks, $artName)
{
	$sql = "INSERT INTO artist (artID, artName) VALUES (?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('is', $artId, $artName);
	$stmt->execute();
	$stmt->close();
	$sql = "INSERT INTO cd (cdID, artID, cdTitle, cdPrice, cdGenre, cdNumTracks) VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('iisdsi', $cdId, $artId, $cdTitle, $cdPrice, $cdGenre, $cdNumTracks);
	$stmt->execute();
	$stmt->close();
}

function deleteEntry($conn, $tables, $artId, $cdId, $artName)
{
	if($tables === "artist")
	{
		$sql = "DELETE FROM cd WHERE artID = " . $artId;
	}
	else if($tables === "cd")
		$sql = "DELETE FROM cd WHERE artID = " . $artId . " AND cdID = " . $cdId;
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$stmt->close();
	if($tables === "artist")
	{
		$sql = "DELETE FROM artist WHERE artID = " . $artId;
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
}
?>