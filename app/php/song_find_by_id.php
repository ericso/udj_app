<?php
// song_find_by_id.php
// Find a song by id from the Songs table

require_once(dirname(__FILE__) . '/includes/global.inc.php');

$logger->log("---------------------------------", 3);
$logger->log("start: queue_save_songs.php", 3);

$songId = $_GET["songId"];
// $escapedSearchText = sqlite_escape_string($searchText);
$escapedSongId = $songId;

$logger->log("song id: $songId", 3);
$logger->log("escaped song id: $escapedSongId", 3);

/*** READ DATA FROM DATABASE ***/
$songArray = array();

/*** SEARCH THE SONGS DATABASE ***/
$results = $db->query("SELECT * FROM Songs WHERE (so_id = '$escapedSongId')");

$logger->log('Length of song array: ' . count($results), 3);

foreach($results as $row) {
  $logger->log("Song id: " . $row['so_id'], 3);
  $logger->log("Song artist: " . $row['so_artist'], 3);
  $logger->log("Song title: " . $row['so_title'], 3);
  $logger->log("Song album: " . $row['so_album'], 3);\
  array_push($songArray, $row);
}

echo json_encode($songArray);

?>