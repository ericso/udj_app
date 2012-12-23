function populateDjs() {
	// Clear the current DJ list
	$('#dj_table' + ' > tbody').empty();

	for (var i=0; i<allDjs.length; i++) {
		// Add the song to the queue
		if (allDjs[i] != null) {
			$('#dj_table' + ' > tbody:last').append('<tr><td><h5>' + allDjs[i].name + '</h5></td><td>' + 'test_venue' + '</td><td><a href="javascript:selectDj(' + allDjs[i].id + ');" class="btn btn-small btn-success"><span class="icon-headphones"></span></a></td></tr>');
		}
	}
}

function selectDj(djId) {
	currentDj = findDjById(djId);
	alert(currentDj.name);
}