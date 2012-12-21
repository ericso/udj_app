// Update the number of songs found
function updateSongList(foundSongs) {
	// Add each found song to the results list
	for (var i = 0; i < foundSongs.length; i++) {
		var divToAppend = $('<div class="well"><a class="pull-left" href="javascript:void(0);"><img class="thumbnail" src="assets/img/holder.png"></a><a href="javascript:addSongToQueue(' + foundSongs[i].id + ');" type="submit" class="btn btn-primary pull-right">Request</a><div class="results-info"><h4>' + foundSongs[i].title + '<span> </span><small>' + foundSongs[i].artist + '</small></h4><p>' + foundSongs[i].album + '</p></div></div>');

		$('#search_results_list').append(divToAppend);
	}
}

function addSongToQueue(songId) {
	// Add song to the queue by id
	var songToAdd = findSongById(songId);

	// Push the song onto the queue array if it isn't already there
	if (findSongInQueue(songId)) {
		upVote(songId)
	} else {
		queueSongs.push(findSongById(songId));
		upVote(songId);
	}

	// Display an alert that song was added
	$(".alert").alert('close');
	newAlert('alert-success', songToAdd.artist + ' - ' + songToAdd.title + ' added to queue.');
}

function removeSongFromQueue(songId) {
	// Remove song from the queue by id
	var songToRemove = findSongById(songId);

	// Add the song to the queue
	if (songToAdd != null) {
		$('#queue_table' + ' > tbody:last').append('<tr><td>' + nextSongIndex + '</td><td><h5>' + songToAdd.title + '  <small>' + songToAdd.artist + '</small></h5></td><td>##</td><td><div class="btn-group"><button id="plus" class="btn btn-small"><strong>+</strong></button><button id="minus" class="btn btn-small"><strong>-</strong></button></div></td></tr>');
		
	if (findSongInQueue(songId)) {
		// Remove the song from the queueSongs array
		queueSongs = $.grep(queueSongs, function(e, i) { return e.id === songId; }, true);
		
		// Display an alert that song was deleted
		$(".alert").alert('close');
		newAlert('alert-success', songToRemove.artist + ' - ' + songToRemove.title + ' removed from queue.');

		// Reload the queue
		updateQueue();
	}
}



function upVote(songId) {
	// Find the song by id
	var songToUpVote = $.grep(queueSongs, function(e) { return e.id === songId; })[0];
	// Increment the votes attribute
	songToUpVote.votes++;
	// Display the new vote count
	$('#' + songToUpVote.id + '_votes').html(songToUpVote.votes);

	// Resort the queue and update it
	resortQueue();
	updateQueue();
}

function downVote(songId) {
	// Find the song by id
	var songToDownVote = $.grep(queueSongs, function(e) { return e.id === songId; })[0];
	// Decrement the votes attribute
	if (songToDownVote.votes > 1) {
		songToDownVote.votes--;
	}
	// Display the new vote count
	$('#' + songToDownVote.id + '_votes').html(songToDownVote.votes);

	// Resort the queue and update it
	resortQueue();
	updateQueue();
}