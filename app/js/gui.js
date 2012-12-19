////////////////////////
/// GLOBAL VARIABLES ///
////////////////////////
var queueSongs; // Songs that are in the queue
var allSongs; // Song "database" to search from and add to
var toAddSongs; // Songs from requests that aren't yet in the database
var foundSongs; // Songs that are found from a search

////////////////////////
/// GUI MANIPULATION ///
////////////////////////
function setupApp() {
	/*** Prepopulate allSongs array with some songs for testing ***/
	allSongs = [{ artist: "Janelle Monae", title: "Many Moons", album: "Metropolis: The Chase Suite" },
				{ artist: "Fun.", title: "Some Nights", album: "Some Nights" },
				{ artist: "MIKA", title: "Love Today", album: "Life in Cartoon Motion" }
	];

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
		foundSongs = [];

		// Empty the song list
		$('#search_results_list').empty();

		// Grab the text from the search box
		var searchText = $('#song_search_input').val();

		var found = false; // Flag set to true if a song is found
		if (searchText) {
			// Search the allSongs array for song
			for (var i = 0; i < allSongs.length; i++) {
				
				if ((allSongs[i].artist.indexOf(searchText) >= 0) || (allSongs[i].title.indexOf(searchText) >= 0) || (allSongs[i].album.indexOf(searchText) >= 0)) {
					found = true;
					// alert(allSongs[i].artist);
					// alert(allSongs[i].title);
					// alert(allSongs[i].album);

					// Push found song onto foundSongs array
					foundSongs.push(allSongs[i]);
				}
			}
		}

		if (found) {
			//alert(foundSongs.length);
			for (var i = 0; i < foundSongs.length; i++) {
				var divToAppend = $('<div class="well"><a class="pull-left" href="javascript:void(0)"><img class="thumbnail" src="assets/img/holder.png"></a><button id="' + 'song' + i + 'id' + '" type="submit" class="btn btn-primary pull-right">Request</button><div class="results-info"><h4>' + foundSongs[i].title + '<span> </span><small>' + foundSongs[i].artist + '</small></h4><p>' + foundSongs[i].album + '</p></div></div>');

				$('#search_results_list').append(divToAppend);
			}
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

// /*** Generate Bootstrap alert box ***/
// function newAlert(type, message) {
// 	$("#alert-area").append($("<div class='alert " + type + " fade in' data-alert><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>" + message + "</div>"));
//     	$("#alert-area .alert").delay(3000).fadeOut("slow", function () { $(this).remove(); });
// }