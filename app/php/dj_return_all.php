<?php

/*** CREATE A LOG FILE ***/
$logfile = "../../logs/dj.log";
error_log("---------------------------------\n", 3, $logfile);
error_log("start: dj_return_all.php\n", 3, $logfile);

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

// TODO: Modify this script so that it grabs the current venues and queues, and returns those along with the DJs

/*** GRAB ALL ROWS FROM THE Djs TABLE ***/
// $query = $database->query("SELECT * FROM Djs");

$query = $database->query("SELECT d.dj_id, d.dj_name, d.dj_email, v.ve_id, v.ve_name, q.qu_id
                           FROM Djs AS d INNER JOIN QueueToDj AS qd
                           ON d.dj_id = qd.qtd_djId JOIN Queues AS q
                           ON qd.qtd_queueId = q.qu_id JOIN QueueToVenue AS qv
                           ON qv.qtv_queueId = q.qu_id JOIN Venues AS v
                           ON qv.qtv_venueId = v.ve_id;");

while($row = $query->fetchArray()) {
  error_log("DJ id: " . $row['dj_id'] . "\n", 3, $logfile);
  error_log("DJ name: " . $row['dj_name'] . "\n", 3, $logfile);
  error_log("DJ email: " . $row['dj_email'] . "\n", 3, $logfile);
  error_log("Venue id: " . $row['ve_id'] . "\n", 3, $logfile);
  error_log("Venue name: " . $row['ve_name'] . "\n", 3, $logfile);
  error_log("Queue id: " . $row['qu_id'] . "\n", 3, $logfile);
  array_push($djarray, $row);
}

echo json_encode($djarray);

?>