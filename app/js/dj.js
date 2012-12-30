function populateDjs() {
	// Grab the DJ list from the database
	alert("about to call dj_return_all");

	$.ajax({
		url: 'app/php/dj_return_all.php',
		dataType: 'json',
		success: function(results) {
			alert("dj_return_all success");

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
		// Add the DJ to the list
		if (djArray[i] != null) {
			var bkgClrStyle = '';
			var activeStyle = '';

			if (currentDj) {
				bkgClrStyle = currentDj.dj_id === djArray[i].dj_id ? 'background-color: #08C' : ''
				activeStyle = currentDj.dj_id === djArray[i].dj_id ? 'active' : ''
			}

			$('#dj_table' + ' > tbody:last').append('<tr style="' + bkgClrStyle + '"><td><h5>' + djArray[i].dj_name + '</h5></td><td>' + djArray[i].ve_name + '</td><td><a href="javascript:selectDj(' + djArray[i].dj_id + ',' + djArray[i].qu_id + ');" class="btn btn-small btn-success ' + activeStyle + ' "><span class="icon-headphones"></span></a></td></tr>');
		}
	}
}

function selectDj(djId, queueId) {
	// If there's a currentDj, save the queue
	// Build the array to save the queue
	// [{ songid, queueid, votes}, ...]

	// Save song queue only if there's a queue to save

	if (undefined != currentQueueId) {
		var songsToSaveArr = [];
		for(var i=0; i<queueSongs.length; i++) {
			songsToSaveArr.push({ 'stq_songId': queueSongs[i].so_id, 'stq_queueId': currentQueueId, 'stq_votes': queueSongs[i].stq_votes });
		}

		$.ajax({
			async: false, // This will block until return; necessary b/c using SQLITE db, can remove when switch to other SQL db
			url: 'app/php/queue_save_songs.php',
			dataType: 'json',
			data: {
				"songsToSaveArr" : songsToSaveArr
			},
			success: function(results) {			
				//alert("songs saved")
			},
			error: function(request, status, error) {
				if (debug){
					alert('Got an error: ' + request.responseText + " status: "+ status + " error: " + error);
				}
			}
		});
	}

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