function populateDjs() {
	// Grab the DJ list from the database
	//alert("in populateDjs");

	$.ajax({
		url: 'app/php/djs.php',
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
				bkgClrStyle = currentDj.id === djArray[i].id ? 'background-color: #08C' : ''
				activeStyle = currentDj.id === djArray[i].id ? 'active' : ''
			}

			$('#dj_table' + ' > tbody:last').append('<tr style="' + bkgClrStyle + '"><td><h5>' + djArray[i].name + '</h5></td><td>' + 'test_venue' + '</td><td><a href="javascript:selectDj(' + djArray[i].id + ');" class="btn btn-small btn-success ' + activeStyle + ' "><span class="icon-headphones"></span></a></td></tr>');
		}
	}
}

function selectDj(djId) {
	currentDj = findDjById(djId); // Set the current DJ by id
	populateDjs(); // Reload the DJ table to show highlighting of current DJ

	// FIX: Right now, the queue will be cleared when the DJ changes. Need to fix so that each DJ has a queue associated with them. This will come with the implementation of the databases
	clearQueue();

	queueTabSwitchTimeout = setTimeout(function () { $('#queue_tab').trigger('click'); }, 500); // Switch to the queue tab after half-second
}