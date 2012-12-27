function populateDjs() {
	// Grab the DJ list from the database
	$.ajax({
		url: 'app/php/dj_return_all.php',
		dataType: 'json',
		success: function(results) {			
			allDjs = results;

			// These loops are for introspection into the returned array
			// for (var i=0; i<results.length; i++) {
			// 	alert(results[i].name);
			// }
			// $(results).each( function(key, value) {
			// 	alert(value.name);
			// });

			// Add the DJs to the table
			addDjsToTable(allDjs);
		},
		error: function(request, status, error) {
			if (debug){
				alert('Got an error: ' + request.responseText + " status: "+ status + " error: " + error);
			}
		}
	});
}

function addDjsToTable(djArray) {
	// Clear the current DJ list
	$('#dj_table' + ' > tbody').empty();

	for (var i=0; i<djArray.length; i++) {
		// Add the song to the queue
		if (djArray[i] != null) {
			var bkgClrStyle = '';
			var activeStyle = '';

			if (currentDj) {
				bkgClrStyle = currentDj.id === djArray[i].dj_id ? 'background-color: #08C' : ''
				activeStyle = currentDj.id === djArray[i].dj_id ? 'active' : ''
			}

			$('#dj_table' + ' > tbody:last').append('<tr style="' + bkgClrStyle + '"><td><h5>' + djArray[i].dj_name + '</h5></td><td>' + djArray[i].ve_name + '</td><td><a href="javascript:selectDj(' + djArray[i].dj_id + ',' + djArray[i].qu_id + ');" class="btn btn-small btn-success ' + activeStyle + ' "><span class="icon-headphones"></span></a></td></tr>');
		}
	}
}

function selectDj(djId, queueId) {
	currentDj = findDjById(djId); // Set the current DJ by id
	currentQueueId = queueId; // Set the current queue id

	// Initialize the DJs song queue, pull this from SongToQueue table
	$.ajax({
		url: 'app/php/queue_return_songs.php',
		dataType: 'json',
		data: {
			"currentQueueId" : currentQueueId
		},
		success: function(results) {			
			queueSongs = results;
		},
		error: function(request, status, error) {
			// Error occured grabbing the queue from the database, set the queue to an empty array
			queueSongs = [];

			if (debug){
				alert('Got an error: ' + request.responseText + " status: "+ status + " error: " + error);
			}
		}
	});
	
	populateDjs(); // Reload the DJ table to show highlighting of current DJ

	queueTabSwitchTimeout = setTimeout(function () { $('#queue_tab').trigger('click'); }, 500); // Switch to the queue tab after half-second
}