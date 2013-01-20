// Handler for song search
function findSongHandler() {
	// Check to see if a DJ has been selected
	if (!currentDj) {
		// Display an alert that a DJ must be selected before switching to this tab
		$(".alert").alert('close');
		newAlert('alert-danger', 'Please select a DJ before proceeding.');
	} else {
		// Grab the text from the search box
		var searchText = $('#song_search_input').val();

		foundFlag = false; // Flag set to true if a song is found
		if (searchText) {
			// Clear the foundSongs array
			var foundSongs = [];

			// Empty the song list
			$('#search_results_list').empty();
			// Search the allSongs array for song
			findSongs(searchText, foundSongs);

			// Switch to the search tab
			$('#search_tab').trigger('click');
		}
	}
}

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
		var divToAppend = $('<div class="well"><a class="pull-left" href="javascript:void(0);"><img class="thumbnail" src="assets/img/holder.png"></a><a href="javascript:addSongToQueue(' + foundSongs[i].so_id + ');" type="submit" class="btn btn-success pull-right">Request</a><div class="results-info"><h4>' + foundSongs[i].so_title + '<span> </span><small>' + foundSongs[i].so_artist + '</small></h4><p>' + foundSongs[i].so_album + '</p></div></div>');

		$('#search_results_list').append(divToAppend);
	}
}

function addSongToQueue(songId) {
	// Push the song onto the queue array if it isn't already there
	//alert('song id: ' + songId);
	
	if (findSongInQueue(songId)) {
		alert('song found: ' + songId);
		upVote(songId);

		// Switch to the queue tab
		$('#queue_tab').trigger('click');
	} else {
		// Find the song in the database and push it onto the queue
		$.ajax({
			url: 'app/php/song_find_by_id.php',
			dataType: 'json',
			data: {"songId" : songId},
			success: function(results) {				
				if (results.length > 0) {
					// Initialize the votes of the song to zero (need to make sure this is appropriate behavior)
					results[0].stq_votes = 0;

					queueSongs.push(results[0]);					
					upVote(songId);

					// Switch to the queue tab
					$('#queue_tab').trigger('click');
				}

				// Bootstrap alert for song add
				$(".alert").alert('close');
				newAlert('alert-success', 'Added ' + results[0].so_artist + ' - ' + results[0].so_title + ' to the queue.');
			},
			error: function(request, status, error) {
				if (debug){
					alert('song_find_by_id location got an error: ' + request.responseText + " status: " + status + " error: " + error);
				}
			}
		});
	}
}

function removeSongFromQueue(songId) {
	// Remove song from the queue by id
	if (findSongInQueue(songId)) {
		// Remove the song from the queueSongs array
		queueSongs = $.grep(queueSongs, function(e, i) { return e.so_id === songId; }, true);

		// Reload the queue
		updateQueue();

		// Remove the song from the SongToQueue table in the database
		$.ajax({
			url: 'app/php/song_remove_from_queue.php',
			dataType: 'json',
			data: {
				"songId" : songId,
				"queueId" : currentQueueId,
			},
			success: function(results) {
				//alert('song deleted');
			},
			error: function(request, status, error) {
				if (debug){
					alert('song_remove_by_id location got an error: ' + request.responseText + " status: " + status + " error: " + error);
				}
			}
		});
	}
}

function upVote(songId) {
	// Find the song by id
	var songToUpVote = $.grep(queueSongs, function(e) { return parseInt(e.so_id) === parseInt(songId); })[0];

	// Increment the votes attribute
	if (songToUpVote.stq_votes) {
		songToUpVote.stq_votes++;
	} else {
		songToUpVote.stq_votes = 1;
	}

	// Display the new vote count
	$('#' + songToUpVote.so_id + '_votes').html(songToUpVote.stq_votes);

	// Resort the queue and update it
	resortQueue();
	updateQueue();
}

function downVote(songId) {
	// Find the song by id
	var songToDownVote = $.grep(queueSongs, function(e) { return parseInt(e.so_id) === parseInt(songId); })[0];
	// Decrement the votes attribute
	if (songToDownVote.stq_votes > 1) {
		songToDownVote.stq_votes--;
	} else {
		songToUpVote.stq_votes = 1;
	}
	// Display the new vote count
	$('#' + songToDownVote.so_id + '_votes').html(songToDownVote.stq_votes);

	// Resort the queue and update it
	resortQueue();
	updateQueue();
}