function updateQueue() {
	// Clear the current queue
	$('#queue_table' + ' > tbody').empty();

	for (var i=0, s=1; i<currentDj.queueSongs.length; i++, s++) {
		// Add the song to the queue
		if (currentDj.queueSongs[i] != null) {
			$('#queue_table' + ' > tbody:last').append('<tr><td>' + s + '</td><td><h5>' + currentDj.queueSongs[i].title + '  <small>' + currentDj.queueSongs[i].artist + '</small></h5></td><td id="' + currentDj.queueSongs[i].id + '_votes' + '">' + currentDj.queueSongs[i].votes + '</td><td><div class="btn-group"><a href="javascript:upVote(' + currentDj.queueSongs[i].id + ');" class="btn btn-small"><span class="icon-thumbs-up"></span></a><a href="javascript:downVote(' + currentDj.queueSongs[i].id + ');" class="btn btn-small"><span class="icon-thumbs-down"></span></a></div></td><td><a href="javascript:removeSongFromQueue(' + currentDj.queueSongs[i].id + ');" class="btn btn-small btn-danger"><span class="icon-remove"></span></a></td></tr>');
		}
	}
}

// Sort the queue in desending order by votes
function resortQueue() {
	currentDj.queueSongs.sort(sortByVotes);
}

// Function determines order of two song requests by their votes
function sortByVotes(a, b) {
	var aVotes = a.votes;
	var bVotes = b.votes;

	return((aVotes < bVotes) ? 1 : ((aVotes > bVotes) ? -1 : 0));
}

// Clear the entire request queue
function clearQueue() {
	// Clear the queue
	currentDj.queueSongs = [];

	// Reload the queue
	updateQueue();
}