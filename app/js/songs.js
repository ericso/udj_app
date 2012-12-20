// Update the number of songs found
function updateSongList(foundSongs) {
	// Add each found song to the results list
	for (var i = 0; i < foundSongs.length; i++) {
		var divToAppend = $('<div class="well"><a class="pull-left" href="javascript:void(0);"><img class="thumbnail" src="assets/img/holder.png"></a><a href="javascript:addSongToQueue(' + foundSongs[i].id + ');" type="submit" class="btn btn-primary pull-right">Request</a><div class="results-info"><h4>' + foundSongs[i].title + '<span> </span><small>' + foundSongs[i].artist + '</small></h4><p>' + foundSongs[i].album + '</p></div></div>');

		$('#search_results_list').append(divToAppend);
	}
}

function addSongToQueue(songId) {
	// Find the song to be added
	var songToAdd = findSongById(songId);

	// Push the song onto the queue array
	queueSongs.push(songToAdd);

	// Display an alert that song was added
	$(".alert").alert('close');
	newAlert('alert-success', songToAdd.artist + ' - ' + songToAdd.title + ' added to queue.')
	
}

function removeSongFromQueue(songPosition) {
	// TODO: implement removing songs from the queue by position
}

function updateQueue() {
	// Clear the current queue
	$('#queue_table' + ' > tbody').empty();

	// This is the index of the song in the table. Need to figure out how to handle these. Prolly get rid of them.

	for (var i=0, s=1; i<queueSongs.length; i++, s++) {
		// Add the song to the queue
		if (queueSongs[i] != null) {
			$('#queue_table' + ' > tbody:last').append('<tr><td>' + s + '</td><td><h5>' + queueSongs[i].title + '  <small>' + queueSongs[i].artist + '</small></h5></td><td id="' + queueSongs[i].id + '_votes' + '">' + queueSongs[i].votes + '</td><td><div class="btn-group"><a href="javascript:upVote(' + queueSongs[i].id + ');" class="btn btn-small"><span class="icon-plus"></span></a><a href="javascript:downVote(' + queueSongs[i].id + ');" class="btn btn-small"><span class="icon-minus"></span></a></div></td></tr>');
		}
	}
}

function upVote(songId) {
	// Find the song by id
	var songToUpVote = $.grep(queueSongs, function(e) { return e.id === songId; })[0];
	// Increment the votes attribute
	songToUpVote.votes++;
	// Display the new vote count
	$('#' + songToUpVote.id + '_votes').html(songToUpVote.votes);
}

function downVote(songId) {
	// Find the song by id
	var songToDownVote = $.grep(queueSongs, function(e) { return e.id === songId; })[0];
	// Decrement the votes attribute
	if (songToDownVote.votes > 0) {
		songToDownVote.votes--;
	}
	// Display the new vote count
	$('#' + songToDownVote.id + '_votes').html(songToDownVote.votes);
}