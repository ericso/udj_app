<?php
// queue_save_songs.php
// Saves the songs in the given queue to the SongToQueue table

require_once(dirname(__FILE__) . '/includes/global.inc.php');

$logger->log("---------------------------------", 3);
$logger->log("start: dj_return_all.php", 3);

$songsToSaveArr = $_GET["songsToSaveArr"];
// [{ songid, queueid, votes }, ...]


// What is in the passed in array?
error_log("----------- Parameter Introspection -----------", 3);
error_log("songsToSaveArr length: " . count($songsToSaveArr), 3);

/*** WRITE DATA TO THE DATABASE ***/

/*** Write each element to the SongToQueue table ***/
$counter = 0;
foreach ($songsToSaveArr as $song) {
  $song_id = $song["stq_songId"];
  $queue_id = $song["stq_queueId"];
  $votes = $song["stq_votes"];

  error_log("----------- SAVING SONG $counter -----------", 3);
  error_log("Song id: " . $song_id, 3);
  error_log("Queue id: " . $queue_id, 3);
  error_log("Number of votes: " . $votes, 3);

  // $query = $database->query("INSERT INTO SongToQueue (stq_songId, stq_queueId, stq_votes)
  //                            VALUES ('$song_id', '$queue_id', '$votes');");
  
  $query = $db->query("INSERT OR REPLACE INTO SongToQueue (stq_songId, stq_queueId, stq_votes) 
                             VALUES ('$song_id', '$queue_id', '$votes');");

  // if (!$database->exec($query)) {
  //   error_log("query execution error\n", 3, $logfile);
  //   error_log("error: " . lastErrorMsg() . "\n", 3, $logfile);
  //   die($error);
  // }

  $counter++;
}

?>