<?php
/// Find a song by id from the Songs table ///

/*** CREATE A LOG FILE ***/
$logfile = '../../logs/songs.log';
error_log("---------------------------------\n", 3, $logfile);
error_log("start: song_find_by_id.php\n", 3, $logfile);

$songId = $_GET["songId"];
// $escapedSearchText = sqlite_escape_string($searchText);
$escapedSongId = $songId;

error_log("song id: $songId\n", 3, $logfile);
error_log("escaped song id: $escapedSongId\n", 3, $logfile);

/*** OPEN THE DATABASE ***/
try {
  // Create or open the database
  $database = new SQLite3('../../databases/request.sqlite');
  error_log("database created\n", 3, $logfile);
} catch(Exception $e) {
  error_log("error: $e\n", 3, $logfile);
  error_log("error: $error\n", 3, $logfile);
  die ($error);
}

/*** READ DATA FROM DATABASE ***/
$songArray = array();

/*** SEARCH THE SONGS DATABASE ***/
$query = $database->query("SELECT * FROM Songs WHERE (so_id = '$escapedSongId')");

while($row = $query->fetchArray()) {
  error_log("Song id: " . $row['so_id'] . "\n", 3, $logfile);
  error_log("Song artist: " . $row['so_artist'] . "\n", 3, $logfile);
  error_log("Song title: " . $row['so_title'] . "\n", 3, $logfile);
  error_log("Song album: " . $row['so_album'] . "\n", 3, $logfile);\
  array_push($songArray, $row);
}

echo json_encode($songArray);

?>