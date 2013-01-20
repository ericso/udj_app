<?php
// queue_return_songs.php
// Returns the songs in the given queue

require_once(dirname(__FILE__) . '/includes/global.inc.php');

$logger->log("---------------------------------", 3);
$logger->log("start: queue_return_songs.php", 3);

// grab the passed-in parameters
$currentQueueId = $_GET["currentQueueId"];

// holds the returned songs
$songarray = array();

// JOIN THE Queue, Song, AND SongToQueue TABLES
$results = $db->query("SELECT s.so_id, s.so_artist, s.so_title, s.so_album, sq.stq_votes
                           FROM Songs AS s INNER JOIN SongToQueue AS sq
                           ON s.so_id = sq.stq_songId JOIN Queues AS q
                           ON sq.stq_queueId = q.qu_id
                           WHERE q.qu_id = '$currentQueueId';");

//$logger->log('MySQL return type: ' . get_class($results), 3);
$logger->log('Length of song array: ' . count($results), 3);

// if no results, query() will return false
// return in that case
if ($results == false) {
  // no songs were returned
  echo json_encode($songarray);
} else {
  foreach($results as $row) {
    $logger->log("----------- RETRIEVING SONG -----------", 3);
    $logger->log("Song id: " . $row['so_id'], 3);
    $logger->log("Song artist: " . $row['so_artist'], 3);
    $logger->log("Song title: " . $row['so_title'], 3);
    $logger->log("Song album: " . $row['so_album'], 3);  
    $logger->log("Amount of votes: " . $row['stq_votes'], 3); 
     
    array_push($songarray, $row);
  }

  echo json_encode($songarray);
}

?>