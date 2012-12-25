<?php

/*** CREATE A LOG FILE ***/
$logfile = '../../logs/dj.log';
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
$djarray = array();

/*** GRAB ALL ROWS FROM THE Djs TABLE ***/
$query = $database->query("SELECT * FROM Djs");

while($row = $query->fetchArray()) {
  error_log("DJ id: " . $row['id'] . "\n", 3, $logfile);
  error_log("DJ name: " . $row['name'] . "\n", 3, $logfile);
  error_log("DJ email: " . $row['email'] . "\n", 3, $logfile);
  array_push($djarray, $row);
}

echo json_encode($djarray);

?>