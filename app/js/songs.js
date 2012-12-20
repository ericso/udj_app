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

	// Add the song to the queue
	
}