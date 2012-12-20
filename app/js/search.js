/*** Prepopulate allSongs array with some songs for testing ***/
// THIS SHOULD BE MOVED TO A DATABASE
var	allSongs = [{ id: 0, artist: "Janelle Monae", title: "Many Moons", album: "Metropolis: The Chase Suite" },
				{ id: 1, artist: "Fun.", title: "Some Nights", album: "Some Nights" },
				{ id: 2, artist: "Fun.", title: "We Are Young", album: "Some Nights" },
				{ id: 3, artist: "MIKA", title: "Love Today", album: "Life in Cartoon Motion" },
				{ id: 4, artist: "Jessie J", title: "Domino", album: "Who You Are" }
];

function findSongs(searchText, foundSongs) {
	var found = false
	for (var i = 0; i < allSongs.length; i++) {
		if ((allSongs[i].artist.indexOf(searchText) >= 0) || (allSongs[i].title.indexOf(searchText) >= 0) || (allSongs[i].album.indexOf(searchText) >= 0)) {
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
	for (var i=0; i<allSongs.length; i++) {
		if (allSongs[i].id == songId) {
			return allSongs[i];
		}
	}

	return null;
}