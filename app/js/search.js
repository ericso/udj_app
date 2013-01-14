// Find songs in the database
function findSongs(searchText, foundSongs) {
	searchText = searchText.toLowerCase();

	$.ajax({
		url: 'app/php/song_search_by_text.php',
		dataType: 'json',
		data: {"searchText" : searchText},
		success: function(results) {			
			foundSongs = results;
			if (foundSongs.length > 0) {
				foundFlag = true;

				// for (var i = 0; i < foundSongs.length; i++) {
				// 	alert(foundSongs[i].artist);
				// 	alert(foundSongs[i].title);
				// 	alert(foundSongs[i].album);
				// 	alert(foundSongs[i].votes);
				// }

				updateSongList(foundSongs);
			}
		},
		error: function(request, status, error) {
			if (debug){
				alert('search_songs location got an error: ' + request.responseText + " status: "+status +" error: "+error);
			}
		}
	});
}

// // Find a song in the database by id
// function findSongById(songId) {
// 	$.ajax({
// 		url: 'app/php/song_find_by_id.php',
// 		dataType: 'json',
// 		data: {"songId" : songId},
// 		success: function(results) {			
// 			foundSongs = results;
// 			if (foundSongs.length > 0) {

// 				// for (var i = 0; i < foundSongs.length; i++) {
// 				// 	alert(foundSongs[i].artist);
// 				// 	alert(foundSongs[i].title);
// 				// 	alert(foundSongs[i].album);
// 				// 	alert(foundSongs[i].votes);
// 				// }

// 				return foundSongs[0];
// 			}

// 			return null;
// 		},
// 		error: function(request, status, error) {
// 			if (debug){
// 				alert('search_songs location got an error: ' + request.responseText + " status: "+status +" error: "+error);
// 			}

// 			return null;
// 		}
// 	});
// }

// Find a song in the queue array by id
function findSongInQueue(songId) {
	return $.grep(queueSongs, function(e) { return parseInt(e.so_id) === parseInt(songId); })[0];
}

// Find a DJ in the database by id
function findDjById(djId) {

	var foundDj = $.grep(allDjs, function(e) { return parseInt(e.dj_id) === parseInt(djId); })[0];
	return foundDj;
}

// Find a DJ in the active DJ array by id
// function findActiveDjById(djId) {
// 	return $.grep(activeDjs, function(e) { return e.id === djId; })[0];
// }