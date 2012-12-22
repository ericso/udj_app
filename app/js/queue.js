function updateQueue() {
	// Clear the current queue
	$('#queue_table' + ' > tbody').empty();

	// This is the index of the song in the table. Need to figure out how to handle these. Prolly get rid of them.

	for (var i=0, s=1; i<queueSongs.length; i++, s++) {
		// Add the song to the queue
		if (queueSongs[i] != null) {
			$('#queue_table' + ' > tbody:last').append('<tr><td>' + s + '</td><td><h5>' + queueSongs[i].title + '  <small>' + queueSongs[i].artist + '</small></h5></td><td id="' + queueSongs[i].id + '_votes' + '">' + queueSongs[i].votes + '</td><td><div class="btn-group"><a href="javascript:upVote(' + queueSongs[i].id + ');" class="btn btn-small"><strong>+</strong></a><a href="javascript:downVote(' + queueSongs[i].id + ');" class="btn btn-small"><strong>-</strong></a></div></td><td><a href="javascript:removeSongFromQueue(' + queueSongs[i].id + ');" class="btn btn-small btn-danger"><span class="icon-remove"></span></a></td></tr>');
		}
	}
}

function resortQueue() {
	queueSongs.sort(sortByVotes);
}

function sortByVotes(a, b) {
	var aVotes = a.votes;
	var bVotes = b.votes;

	return((aVotes < bVotes) ? 1 : ((aVotes > bVotes) ? -1 : 0));
}