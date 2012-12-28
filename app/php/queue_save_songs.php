<?php
// Saves the songs in the given queue to the database //

/*** CREATE A LOG FILE ***/
$logfile = '../../logs/queue.log';
error_log("---------------------------------\n", 3, $logfile);
error_log("start: queue_save_songs.php\n", 3, $logfile);

$songsToSaveArr = $_GET["songsToSaveArr"];
// [{ songid, queueid, votes }, ...]

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

// What is in the passed in array?
error_log("----------- Parameter Introspection -----------\n", 3, $logfile);
error_log("songsToSaveArr length: " . count($songsToSaveArr) . "\n", 3, $logfile);

/*** WRITE DATA TO THE DATABASE ***/

/*** Write each element to the SongToQueue table ***/
$counter = 0;
foreach ($songsToSaveArr as $song) {
  $song_id = $song["stq_songId"];
  $queue_id = $song["stq_queueId"];
  $votes = $song["stq_votes"];

  error_log("----------- SAVING SONG $counter -----------\n", 3, $logfile);
  error_log("Song id: " . $song_id . "\n", 3, $logfile);
  error_log("Queue id: " . $queue_id . "\n", 3, $logfile);
  error_log("Number of votes: " . $votes . "\n", 3, $logfile);

  // $query = $database->query("INSERT INTO SongToQueue (stq_songId, stq_queueId, stq_votes)
  //                            VALUES ('$song_id', '$queue_id', '$votes');");
  
  $query = $database->query("INSERT OR REPLACE INTO SongToQueue (stq_songId, stq_queueId, stq_votes) 
                             VALUES ('$song_id', '$queue_id', '$votes');");

  // if (!$database->exec($query)) {
  //   error_log("query execution error\n", 3, $logfile);
  //   error_log("error: " . lastErrorMsg() . "\n", 3, $logfile);
  //   die($error);
  // }

  $counter++;
}

?>