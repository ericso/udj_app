<?php

/*** CREATE A LOG FILE ***/
$logfile = '../../logs/dj.log';
error_log("start\n", 3, $logfile);

/*** OPEN THE DATABASE ***/
try {
  // Create or open the database
  // $djDatabase = new SQLiteDatabase('../../databases/djs.sqlite', 0666, $error);
  $djDatabase = new SQLite3('../../databases/djs.sqlite');
  error_log("database created\n", 3, $logfile);
} catch(Exception $e) {
  error_log("error: $e\n", 3, $logfile);
  error_log("error: $error\n", 3, $logfile);
  die ($error);
}


// /*** CREATE THE Djs TABLE ***/
// $query = 'CREATE TABLE Djs ' .
//          '(id INTEGER, name TEXT, email TEXT, PRIMARY KEY (id))';

// // if (!$djDatabase->queryExec($query, $error)) {
// if (!$djDatabase->exec($query)) {
//   error_log("error: $error\n", 3, $logfile);
//   die($error);
// }

// /*** ADD DATA TO THE TABLE ***/ 
// $query = 
//   'INSERT INTO Djs (id, name, email) ' .
//   'VALUES (0, "DJ RanMan", "djranman@gmail.com"); ' .

//   'INSERT INTO Djs (id, name, email) ' .
//   'VALUES (1, "DJ Jazzy Jeff", "jazzyjeff@gmail.com"); ' .

//   'INSERT INTO Djs (id, name, email) ' .
//   'VALUES (2, "Skrillex", "skrillex@gmail.com"); ' .

//   'INSERT INTO Djs (id, name, email) ' .
//   'VALUES (3, "SleeperCell", "sleepercell@gmail.com"); ' .

//   'INSERT INTO Djs (id, name, email) ' .
//   'VALUES (4, "DeadMau5", "deadmau5@gmail.com"); ';
  
// // if (!$djDatabase->queryExec($query, $error)) {
// if (!$djDatabase->exec($query)) {
//   error_log("error: $error\n", 3, $logfile);
//   die($error);
// }


/*** READ DATA FROM DATABASE ***/
$djarray = array();

/*** GRAB ALL ROWS FROM THE Djs TABLE ***/
$query = $djDatabase->query("SELECT * FROM Djs");
// if ($result = $djDatabase->query($query, SQLITE_BOTH, $error)) {
// if ($result = $djDatabase->query($query)) {

while($row = $query->fetchArray()) {
  error_log("DJ id: " . $row['id'] . "\n", 3, $logfile);
  error_log("DJ name: " . $row['name'] . "\n", 3, $logfile);
  error_log("DJ email: " . $row['email'] . "\n", 3, $logfile);
  array_push($djarray, $row);
}

// } else {
//   error_log("error: $error\n", 3, $logfile);
//   die ($error);
// }

echo json_encode($djarray);

?>