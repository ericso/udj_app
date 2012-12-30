<?php
/// Remove a song from the SongToQueue table ///

/*** CREATE A LOG FILE ***/
$logfile = '../../logs/songs.log';
error_log("---------------------------------\n", 3, $logfile);
error_log("start: song_remove_from_queue.php\n", 3, $logfile);

$songId = $_GET["songId"];
$queueId = $_GET["queueId"];

error_log("song id: $songId\n", 3, $logfile);
error_log("queue id: $queueId\n", 3, $logfile);

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

/*** REMOVE THE SONG FROM THE DATABASE ***/
$query = $database->query("DELETE FROM SongToQueue WHERE (stq_songId = '$songId') AND (stq_queueId = '$queueId');");

?>