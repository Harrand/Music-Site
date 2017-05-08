function validateArtistForm(form)
{
	var name = form.search_artist_name.value;
	var id = form.search_artist_id.value;
	if(name !== "" && id !== "")
	{
		alert("You can only search for a name OR an ID, ignoring the ID field...");
	}
	else if(name === "" && id !== "" && isNaN(id))
	{
		alert("You must submit a number for the id.");
		form.search_artist_id.value = "";
		return false;
	}
	return true;
}

function validateAlbumForm(form)
{
	var name = form.search_album_name.value;
	var id = form.search_album_id.value;
	var minPrice = form.search_album_price_min.value;
	var maxPrice = form.search_album_price_max.value;
	if(name !== "" && id !== "")
	{
		alert("You can only search for a name OR an ID, ignoring the ID field...");
	}
	else if(name === "" && id !== "" && isNaN(id))
	{
		alert("You must submit a number for the id.");
		// Can't use id because primitives are passed by value
		form.search_album_id.value = "";
		return false;
	}
	if(minPrice !== "" && isNaN(minPrice))
	{
		alert("You must submit a number for the minimum price.");
		form.search_album_price_min.value = "";
		return false;
	}
	if(maxPrice !== "" && isNaN(maxPrice))
	{
		alert("You must submit a number for the maximum price.");
		form.search_album_price_max.value = "";
		return false;
	}
	if(minPrice !== "" && maxPrice !== "" && minPrice > maxPrice)
	{
		alert("The minimum price cannot be greater than the maximum! Aborted.");
		return false;
	}
	return true;
}

function validateEditForm(form)
{
	var artId = form.edit_artist_id.value;
	var cdId = form.edit_album_id.value;
	var cdTitle = form.edit_album_title.value;
	var cdPrice = form.edit_album_price.value;
	var cdGenre = form.edit_album_genre.value;
	var cdNumTracks = form.edit_album_num_tracks.value;
	var artName = form.edit_artist_name.value;
	if(cdPrice !== "" && isNaN(cdPrice))
	{
		alert("You must submit a number for the cd price.");
		form.edit_album_price.value = "";
		return false;
	}
	if(cdNumTracks !== "" && isNaN(cdNumTracks))
	{
		alert("You must submit a number for the number of tracks.");
		form.edit_album_num_tracks.value = "";
		return false;
	}
	return true;
}