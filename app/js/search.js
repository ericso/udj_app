/*** Prepopulate allSongs array with some songs for testing ***/
// THIS SHOULD BE MOVED TO A DATABASE
var	allSongs = [{ id: 0, artist: "Janelle Monae", title: "Many Moons", album: "Metropolis: The Chase Suite", votes: 0 },
				{ id: 1, artist: "Fun.", title: "Some Nights", album: "Some Nights", votes: 0 },
				{ id: 2, artist: "Fun.", title: "We Are Young", album: "Some Nights", votes: 0 },
				{ id: 3, artist: "MIKA", title: "Love Today", album: "Life in Cartoon Motion", votes: 0 },
				{ id: 4, artist: "Jessie J", title: "Domino", album: "Who You Are", votes: 0 }
];

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

function findSongById(songId) {
	return $.grep(allSongs, function(e) { return e.id === songId; })[0];
}

function findSongInQueue(songId) {
	return $.grep(queueSongs, function(e) { return e.id === songId; })[0];
}