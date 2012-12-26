// Update the number of songs found
function updateSongList(foundSongs) {
	if (foundFlag) {
		// Update the number of songs found
		var foundSongsText = foundSongs.length + (foundSongs.length == 1 ? ' song found.' : ' songs found.');
		$('#number_songs_found').html(foundSongsText);

		foundFlag = false;
	} else {
		$('#number_songs_found').html('No songs found.');

		// Send an alert after closing current alert
		$(".alert").alert('close');
		newAlert('warning', 'No songs found.')
	}

	// Add each found song to the results list
	for (var i = 0; i < foundSongs.length; i++) {
		var divToAppend = $('<div class="well"><a class="pull-left" href="javascript:void(0);"><img class="thumbnail" src="assets/img/holder.png"></a><a href="javascript:addSongToQueue(' + foundSongs[i].id + ');" type="submit" class="btn btn-success pull-right">Request</a><div class="results-info"><h4>' + foundSongs[i].title + '<span> </span><small>' + foundSongs[i].artist + '</small></h4><p>' + foundSongs[i].album + '</p></div></div>');

		$('#search_results_list').append(divToAppend);
	}
}

function addSongToQueue(songId) {
	// Push the song onto the queue array if it isn't already there
	if (findSongInQueue(songId)) {
		upVote(songId);
	} else {
		// Find the song in the database and push it onto the queue
		$.ajax({
			url: 'app/php/song_find_by_id.php',
			dataType: 'json',
			data: {"songId" : songId},
			success: function(results) {
				if (results.length > 0) {
					currentDj.queueSongs.push(results[0]);					
					upVote(songId);
				}
			},
			error: function(request, status, error) {
				if (debug){
					alert('search_songs location got an error: ' + request.responseText + " status: "+status +" error: "+error);
				}
			}
		});
	}
}

function removeSongFromQueue(songId) {
	// Remove song from the queue by id
	if (findSongInQueue(songId)) {
		// Remove the song from the queueSongs array
		currentDj.queueSongs = $.grep(currentDj.queueSongs, function(e, i) { return e.id === songId; }, true);

		// Reload the queue
		updateQueue();
	}
}

function upVote(songId) {
	// Find the song by id
	var songToUpVote = $.grep(currentDj.queueSongs, function(e) { return e.id === songId; })[0];

	// Increment the votes attribute
	if (songToUpVote.votes) {
		songToUpVote.votes++;
	} else {
		songToUpVote.votes = 1;
	}

	// Display the new vote count
	$('#' + songToUpVote.id + '_votes').html(songToUpVote.votes);

	// Resort the queue and update it
	resortQueue();
	updateQueue();
}

function downVote(songId) {
	// Find the song by id
	var songToDownVote = $.grep(currentDj.queueSongs, function(e) { return e.id === songId; })[0];
	// Decrement the votes attribute
	if (songToDownVote.votes > 1) {
		songToDownVote.votes--;
	} else {
		songToUpVote.votes = 1;
	}
	// Display the new vote count
	$('#' + songToDownVote.id + '_votes').html(songToDownVote.votes);

	// Resort the queue and update it
	resortQueue();
	updateQueue();
}