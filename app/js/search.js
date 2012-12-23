// Find songs in the database
function findSongs(searchText, foundSongs) {
	var found = false
	searchText = searchText.toLowerCase();

	for (var i = 0; i < allSongs.length; i++) {
		if ((allSongs[i].artist.toLowerCase().indexOf(searchText) >= 0) || (allSongs[i].title.toLowerCase().indexOf(searchText) >= 0) || (allSongs[i].album.toLowerCase().indexOf(searchText) >= 0)) {
			found = true;
			// alert(allSongs[i].artist);
			// alert(allSongs[i].title);
			// alert(allSongs[i].album);

			// Push found song onto foundSongs array
			foundSongs.push(allSongs[i]);
		}
	}

	return found;
}

// Find a song in the database by id
function findSongById(songId) {
	return $.grep(allSongs, function(e) { return e.id === songId; })[0];
}

// Find a song in the queue array by id
function findSongInQueue(songId) {
	return $.grep(queueSongs, function(e) { return e.id === songId; })[0];
}

// Find a DJ in the database by id
function findDjById(djId) {
	return $.grep(allDjs, function(e) { return e.id === djId; })[0];
}