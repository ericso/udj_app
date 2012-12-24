function updateQueue() {
	// Clear the current queue
	$('#queue_table' + ' > tbody').empty();

	for (var i=0, s=1; i<queueSongs.length; i++, s++) {
		// Add the song to the queue
		if (queueSongs[i] != null) {
			$('#queue_table' + ' > tbody:last').append('<tr><td>' + s + '</td><td><h5>' + queueSongs[i].title + '  <small>' + queueSongs[i].artist + '</small></h5></td><td id="' + queueSongs[i].id + '_votes' + '">' + queueSongs[i].votes + '</td><td><div class="btn-group"><a href="javascript:upVote(' + queueSongs[i].id + ');" class="btn btn-small"><span class="icon-thumbs-up"></span></a><a href="javascript:downVote(' + queueSongs[i].id + ');" class="btn btn-small"><span class="icon-thumbs-down"></span></a></div></td><td><a href="javascript:removeSongFromQueue(' + queueSongs[i].id + ');" class="btn btn-small btn-danger"><span class="icon-remove"></span></a></td></tr>');
		}
	}
}

// Sort the queue in desending order by votes
function resortQueue() {
	queueSongs.sort(sortByVotes);
}

// Function determines order of two song requests by their votes
function sortByVotes(a, b) {
	var aVotes = a.votes;
	var bVotes = b.votes;

	return((aVotes < bVotes) ? 1 : ((aVotes > bVotes) ? -1 : 0));
}

// Clear the entire request queue
function clearQueue() {
	var songToRemove;

	for (var i=0; i<queueSongs.length; i++) {
		if (queueSongs[i] != null) {
			songToRemove = findSongById(queueSongs[i].id);

			if (findSongInQueue(songToRemove.id)) {
				// Reset the votes count of the removed song
				songToRemove.votes = 0;
			}
		}
	}
	// Clear the queue
	queueSongs = [];

	// Reload the queue
	updateQueue();
	
}