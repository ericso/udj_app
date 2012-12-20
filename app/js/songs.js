// Update the number of songs found
function updateSongList(foundSongs) {
	// Add each found song to the results list
	for (var i = 0; i < foundSongs.length; i++) {
		var divToAppend = $('<div class="well"><a class="pull-left" href="javascript:void(0);"><img class="thumbnail" src="assets/img/holder.png"></a><a href="javascript:addSongToQueue(' + foundSongs[i].id + ');" type="submit" class="btn btn-primary pull-right">Request</a><div class="results-info"><h4>' + foundSongs[i].title + '<span> </span><small>' + foundSongs[i].artist + '</small></h4><p>' + foundSongs[i].album + '</p></div></div>');

		$('#search_results_list').append(divToAppend);
	}
}

function addSongToQueue(songId) {
	//alert(songId);

	var nextSongIndex = 1; // This is the index of the song in the table. Need to figure out how to handle these. Prolly get rid of them.

	// Find the song to be added
	var songToAdd = findSongById(songId);

	// Add the song to the queue
	if (songToAdd != null) {
		$('#queue_table' + ' > tbody:last').append('<tr><td>' + nextSongIndex + '</td><td><h5>' + songToAdd.title + '  <small>' + songToAdd.artist + '</small></h5></td><td>##</td><td><div class="btn-group"><button id="plus" class="btn btn-small"><span class="icon-plus"></span></button><button id="minus" class="btn btn-small"><span class="icon-minus"></span></button></div></td></tr>');
		newAlert('alert-success', songToAdd.artist + ' - ' + songToAdd.title + ' added to queue.')
	}
}