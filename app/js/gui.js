////////////////////////
/// GLOBAL VARIABLES ///
////////////////////////
var queueSongs; // Songs that are in the queue
var toAddSongs; // Songs from requests that aren't yet in the database

////////////////////////
/// GUI MANIPULATION ///
////////////////////////
function setupApp() {
	/*** Switching tabs event handlers ***/
	$('#index_tab').click( function() {
		// Find the currently active tab and switch the tab
		var activeTab = $('#nav_bar .active');
		switchTab(activeTab.attr('id'), 'index_tab');

	});
	$('#queue_tab').click( function() {
		// Find the currently active tab and switch the tab
		var activeTab = $('#nav_bar .active');
		switchTab(activeTab.attr('id'), 'queue_tab');

	});
	$('#search_tab').click( function() {
		// Find the currently active tab and switch the tab
		var activeTab = $('#nav_bar .active');
		switchTab(activeTab.attr('id'), 'search_tab');

	});
	$('#help_tab').click( function() {
		// Find the currently active tab and switch the tab
		var activeTab = $('#nav_bar .active');
		switchTab(activeTab.attr('id'), 'help_tab');

	});

	/*** Searching for songs event handlers ***/
	$('#song_search_button').click ( function() {
		// Clear the foundSongs array
		var foundSongs = [];

		// Empty the song list
		$('#search_results_list').empty();

		// Grab the text from the search box
		var searchText = $('#song_search_input').val();

		var foundFlag = false; // Flag set to true if a song is found
		if (searchText) {
			// Search the allSongs array for song
			foundFlag = findSongs(searchText, foundSongs);
		}

		if (foundFlag) {
			// Update the number of songs found
			updateSongList(foundSongs);
			var foundSongsText = foundSongs.length + (foundSongs.length == 1 ? ' song found.' : ' songs found.');
			$('#number_songs_found').html(foundSongsText);
			newAlert('alert-success', foundSongsText);
		} else {
			$('#number_songs_found').html('No songs found.');
			newAlert('warning', 'No songs found.')
		}
	});
}

// Handles switching the tabs
function switchTab(fromTab, toTab) {
	if (!$('#' + toTab).hasClass('disabled') && !$("#" + toTab).hasClass('active')) {
		// Hide the currently active tab
		$('#' + fromTab + "_div").slideUp();
		// Remove the active state from the tab
		$('#' + fromTab).removeClass('active');

		//alert("about to show div");

		// Show the new tab
		$('#' + toTab + "_div").slideDown();
		// Add active state to the tab
		$('#' + toTab).addClass('active');
	}
}

/*** Generate Bootstrap alert box ***/
function newAlert(type, message) {
	$("#alert-area").append($("<div class='alert " + type + " fade in' data-alert><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>" + message + "</div>"));
    	$("#alert-area .alert").delay(3000).fadeOut("slow", function () { $(this).remove(); });
}