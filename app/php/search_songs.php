<?php

/*** CREATE A LOG FILE ***/
$logfile = '../../logs/songs.log';
error_log("start\n", 3, $logfile);

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
//$query = $database->query("SELECT * FROM Songs");

while($row = $query->fetchArray()) {
  error_log("Song id: " . $row['id'] . "\n", 3, $logfile);
  error_log("Song artist: " . $row['artist'] . "\n", 3, $logfile);
  error_log("Song title: " . $row['title'] . "\n", 3, $logfile);
  error_log("Song album: " . $row['album'] . "\n", 3, $logfile);
  error_log("Song votes: " . $row['votes'] . "\n", 3, $logfile);
  array_push($songArray, $row);
}

echo json_encode($songArray);

?>