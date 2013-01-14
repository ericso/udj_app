<?php
/// Returns the songs in the given queue ///

/*** CREATE A LOG FILE ***/
$logfile = '../../logs/queue.log';
error_log("---------------------------------\n", 3, $logfile);
error_log("start: queue_return_songs.php\n", 3, $logfile);

$currentQueueId = $_GET["currentQueueId"];

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
$songarray = array();

/*** JOIN THE Queue, Song, AND SongToQueue TABLES ***/
$query = $database->query("SELECT s.so_id, s.so_artist, s.so_title, s.so_album, sq.stq_votes
                           FROM Songs AS s INNER JOIN SongToQueue AS sq
                           ON s.so_id = sq.stq_songId JOIN Queues AS q
                           ON sq.stq_queueId = q.qu_id
                           WHERE q.qu_id = '$currentQueueId';");

while($row = $query->fetchArray()) {
  error_log("----------- RETRIEVING SONG -----------\n", 3, $logfile);
  error_log("Song id: " . $row['so_id'] . "\n", 3, $logfile);
  error_log("Song artist: " . $row['so_artist'] . "\n", 3, $logfile);
  error_log("Song title: " . $row['so_title'] . "\n", 3, $logfile);
  error_log("Song album: " . $row['so_album'] . "\n", 3, $logfile);  
  error_log("Amount of votes: " . $row['stq_votes'] . "\n", 3, $logfile); 
   
  array_push($songarray, $row);
}

echo json_encode($songarray);

?>