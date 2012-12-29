function updateQueue() {
	// Clear the current queue
	$('#queue_table' + ' > tbody').empty();

	// FIX: add ajax call to get the number of votes for each song

	for (var i=0, s=1; i<queueSongs.length; i++, s++) {
		// Add the song to the queue
		if (queueSongs[i] != null) {
			$('#queue_table' + ' > tbody:last').append('<tr><td>' + s + '</td><td><h5>' + queueSongs[i].so_title + '  <small>' + queueSongs[i].so_artist + '</small></h5></td><td id="' + queueSongs[i].so_id + '_votes' + '">' + queueSongs[i].stq_votes + '</td><td><div class="btn-group"><a href="javascript:upVote(' + queueSongs[i].so_id + ');" class="btn btn-small"><span class="icon-thumbs-up"></span></a><a href="javascript:downVote(' + queueSongs[i].so_id + ');" class="btn btn-small"><span class="icon-thumbs-down"></span></a></div></td><td><a href="javascript:removeSongFromQueue(' + queueSongs[i].so_id + ');" class="btn btn-small btn-danger"><span class="icon-remove"></span></a></td></tr>');
		}
	}
}

// Sort the queue in desending order by votes
function resortQueue() {
	queueSongs.sort(sortByVotes);
}

// Function determines order of two song requests by their votes
function sortByVotes(a, b) {
	var aVotes = a.stq_votes;
	var bVotes = b.stq_votes;

	return((aVotes < bVotes) ? 1 : ((aVotes > bVotes) ? -1 : 0));
}

// Clear the entire request queue
function clearQueue() {
	// Clear the queue
	queueSongs = [];

	// Reload the queue
	updateQueue();
}