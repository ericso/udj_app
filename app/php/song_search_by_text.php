<?php
// song_search_by_text.php
// Find a song using search text from the Songs table

require_once(dirname(__FILE__) . '/includes/global.inc.php');

$logger->log("---------------------------------", 3);
$logger->log("start: song_search_by_text.php", 3);


$searchText = $_GET["searchText"];
// $escapedSearchText = sqlite_escape_string($searchText);
$escapedSearchText = $searchText;

$logger->log("search text: $searchText", 3);
$logger->log("escaped search text: $escapedSearchText", 3);

/*** READ DATA FROM DATABASE ***/
$songArray = array();

/*** SEARCH THE SONGS DATABASE ***/
$results = $db->query("SELECT * FROM Songs WHERE (so_artist LIKE '%$searchText%') OR (so_title LIKE '%$searchText%') OR (so_album LIKE '%$searchText%');");

$logger->log('Length of song array: ' . count($results), 3);

foreach($results as $row) {
  $logger->log("Song id: " . $row['so_id'], 3);
  $logger->log("Song title: " . $row['so_title'], 3);
  $logger->log("Song artist: " . $row['so_artist'], 3);
  $logger->log("Song album: " . $row['so_album'], 3);
  array_push($songArray, $row);
}

echo json_encode($songArray);

?>