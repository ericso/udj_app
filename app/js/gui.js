////////////////////////
/// GUI MANIPULATION ///
////////////////////////
function setupApp() {
	/*** Switching tabs event handlers ***/
	$('#index_tab').click( function() {
		// Cancel timeout
		if (queueTabSwitchTimeout) {
			clearTimeout(queueTabSwitchTimeout);
		}

		// Update the DJ list
		populateDjs();

		// Find the currently active tab and switch the tab
		var activeTab = $('#nav_bar .active');
		switchTab(activeTab.attr('id'), 'index_tab');

	});
	$('#queue_tab').click( function() {
		// Cancel timeout
		if (queueTabSwitchTimeout) {
			clearTimeout(queueTabSwitchTimeout);
		}

		// Check to see if a DJ has been selected
		if (!currentDj) {
			// Display an alert that a DJ must be selected before switching to this tab
			$(".alert").alert('close');
			newAlert('alert-danger', 'Please select a DJ before proceeding.');
		} else {
			// Before switching to queue tab, update the queue
			updateQueue();
			// Display the DJ name
			$('#dj_name_bill').html(currentDj.name);

			// Find the currently active tab and switch the tab
			var activeTab = $('#nav_bar .active');
			switchTab(activeTab.attr('id'), 'queue_tab');
		}
	});
	$('#search_tab').click( function() {
		// Cancel timeout
		if (queueTabSwitchTimeout) {
			clearTimeout(queueTabSwitchTimeout);
		}

		// Check to see if a DJ has been selected
		if (!currentDj) {
			// Display an alert that a DJ must be selected before switching to this tab
			$(".alert").alert('close');
			newAlert('alert-danger', 'Please select a DJ before proceeding.');
		} else {
			// Find the currently active tab and switch the tab
			var activeTab = $('#nav_bar .active');
			switchTab(activeTab.attr('id'), 'search_tab');
		}
	});
	$('#help_tab').click( function() {
		// Cancel timeout
		if (queueTabSwitchTimeout) {
			clearTimeout(queueTabSwitchTimeout);
		}
		
		// Find the currently active tab and switch the tab
		var activeTab = $('#nav_bar .active');
		switchTab(activeTab.attr('id'), 'help_tab');
	});
	$('#share_tab').click( function() {
		// Cancel timeout
		if (queueTabSwitchTimeout) {
			clearTimeout(queueTabSwitchTimeout);
		}
		
		// Find the currently active tab and switch the tab
		var activeTab = $('#nav_bar .active');
		switchTab(activeTab.attr('id'), 'share_tab');
	});
	$('#login_tab').click( function() {
		// Cancel timeout
		if (queueTabSwitchTimeout) {
			clearTimeout(queueTabSwitchTimeout);
		}
		
		// Find the currently active tab and switch the tab
		var activeTab = $('#nav_bar .active');
		switchTab(activeTab.attr('id'), 'login_tab');
	});


	/*** Searching for songs event handlers ***/
	//$('#song_search_button').click ( function() { findSongHandler() });

	// Enter key submits search query
	$("#song_search_input").keyup( function(event) {
		if (event.keyCode == 13) { // Enter key
			findSongHandler();
		}
	});

	$(document).ready( function() {
		// CREATE DATABASES
		$.ajax({
			url: 'app/php/create_db.php',
			dataType: 'json',
			success: function() {
				// Populate the DJ list
				populateDjs();
			},
			error: function(request, status, error) {
				if (debug){
					alert('Got an error: ' + request.responseText + " status: "+ status + " error: " + error);
				}
			}
		});
		
		// Set the list of active DJs FIX: need to pull this from a database
		//activeDjs = [];
	});
	
}

// Handles switching the tabs
function switchTab(fromTab, toTab) {
	if (!$('#' + toTab).hasClass('disabled') && !$("#" + toTab).hasClass('active')) {
		// Hide the curretly active tab
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