//////////////////////// /// GLOBAL VARIABLES /// ////////////////////////
var queueSongs; // Songs that are in the queue
var pageLoadTimeout; // Holds timeout for transitioning from brand tab to queue tab
var currentDj; // The currently selected DJ

var queueTabSwitchTimeout; // Timeout for switching to the queue tab

/*** Prepopulate allSongs array with some songs for testing ***/
// THIS SHOULD BE MOVED TO A DATABASE
var	allSongs = [{ id: 0, artist: "Janelle Monae", title: "Many Moons", album: "Metropolis: The Chase Suite", votes: 0 },
				{ id: 1, artist: "Fun.", title: "Some Nights", album: "Some Nights", votes: 0 },
				{ id: 2, artist: "Fun.", title: "We Are Young", album: "Some Nights", votes: 0 },
				{ id: 3, artist: "MIKA", title: "Love Today", album: "Life in Cartoon Motion", votes: 0 },
				{ id: 4, artist: "Jessie J", title: "Domino", album: "Who You Are", votes: 0 }
];

/*** Prepopulate allDjs array with DJs for testing ***/
// THIS SHOULD BE MOVED TO A DATABASE
var	allDjs = [{ id: 0, name: "DJ RanMan", email: "djranman@gmail.com" },
				{ id: 1, name: "DJ Jazzy Jeff", email: "jazzyjeff@gmail.com" },
				{ id: 2, name: "Skrillex", email: "skrillex@gmail.com" },
				{ id: 3, name: "SleeperCell", email: "sleepercell@gmail.com" },
				{ id: 4, name: "DeadMau5", email: "deadmau5@gmail.com" }
];