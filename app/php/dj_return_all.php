<?php
// dj_return_all.php
// returns all the DJs from the Djs table
// also returns the appropriate Venues and Queues

require_once(dirname(__FILE__) . '/includes/global.inc.php');

$logger->log("---------------------------------", 3);
$logger->log("start: dj_return_all.php", 3);


$djarray = array();

// TODO: Modify this script so that it grabs the current venues and queues, and returns those along with the DJs

// grab all the djs from the table
// $query = $database->query("SELECT * FROM Djs");

$results = $db->query("SELECT d.dj_id, d.dj_name, d.dj_email, v.ve_id, v.ve_name, q.qu_id
                           FROM djs AS d INNER JOIN queuetodj AS qd
                           ON d.dj_id = qd.qtd_djId JOIN queues AS q
                           ON qd.qtd_queueId = q.qu_id JOIN queuetovenue AS qv
                           ON qv.qtv_queueId = q.qu_id JOIN venues AS v
                           ON qv.qtv_venueId = v.ve_id;");

$logger->log('Length of DJ array: ' . count($results), 3);

foreach($results as $row) {
  $logger->log("DJ id: " . $row['dj_id'], 3);
  $logger->log("DJ name: " . $row['dj_name'], 3);
  $logger->log("DJ email: " . $row['dj_email'], 3);
  $logger->log("Venue id: " . $row['ve_id'], 3);
  $logger->log("Venue name: " . $row['ve_name'], 3);
  $logger->log("Queue id: " . $row['qu_id'], 3);
  
  array_push($djarray, $row);
}

echo json_encode($djarray);

?>