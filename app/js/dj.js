function populateDjs() {
	// Clear the current DJ list
	$('#dj_table' + ' > tbody').empty();

	for (var i=0; i<allDjs.length; i++) {
		// Add the song to the queue
		if (allDjs[i] != null) {
			var bkgClrStyle = '';
			var activeStyle = '';

			if (currentDj) {
				bkgClrStyle = currentDj.id === allDjs[i].id ? 'background-color: #08C' : ''
				activeStyle = currentDj.id === allDjs[i].id ? 'active' : ''
			}

			$('#dj_table' + ' > tbody:last').append('<tr style="' + bkgClrStyle + '"><td><h5>' + allDjs[i].name + '</h5></td><td>' + 'test_venue' + '</td><td><a href="javascript:selectDj(' + allDjs[i].id + ');" class="btn btn-small btn-success ' + activeStyle + ' "><span class="icon-headphones"></span></a></td></tr>');
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