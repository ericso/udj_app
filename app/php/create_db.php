<?php

/*** CREATE A LOG FILE ***/
$logfile = '../../logs/database.log';
error_log("---------------------------------\n", 3, $logfile);
error_log("start: create_db.php\n", 3, $logfile);

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


/*** CREATE THE Djs TABLE ***/
$query = 'CREATE TABLE Djs ' .
         '(dj_id INTEGER, dj_name TEXT, dj_email TEXT, PRIMARY KEY (dj_id));';

if (!$database->exec($query)) {
  error_log("error: $error\n", 3, $logfile);
  die($error);
}

error_log("DJs table created\n", 3, $logfile);

/*** ADD DATA TO THE TABLE ***/ 
$query = 
  'INSERT INTO Djs (dj_id, dj_name, dj_email) ' .
  'VALUES (0, "DJ RanMan", "djranman@gmail.com"); ' .

  'INSERT INTO Djs (dj_id, dj_name, dj_email) ' .
  'VALUES (1, "DJ Jazzy Jeff", "jazzyjeff@gmail.com"); ' .

  'INSERT INTO Djs (dj_id, dj_name, dj_email) ' .
  'VALUES (2, "Skrillex", "skrillex@gmail.com"); ' .

  'INSERT INTO Djs (dj_id, dj_name, dj_email) ' .
  'VALUES (3, "SleeperCell", "sleepercell@gmail.com"); ' .

  'INSERT INTO Djs (dj_id, dj_name, dj_email) ' .
  'VALUES (4, "DeadMau5", "deadmau5@gmail.com"); ';

if (!$database->exec($query)) {
  error_log("error: $error\n", 3, $logfile);
  die($error);
}


/*** CREATE THE Songs TABLE ***/
$query = 'CREATE TABLE Songs ' .
         '(so_id INTEGER, so_artist TEXT, so_title TEXT, so_album TEXT, PRIMARY KEY (so_id));';

if (!$database->exec($query)) {
  error_log("error: $error\n", 3, $logfile);
  die($error);
}

error_log("Songs table created\n", 3, $logfile);

/*** ADD DATA TO THE TABLE ***/ 
$query = 
  'INSERT INTO Songs (so_id, so_artist, so_title, so_album) ' .
  'VALUES (0, "Janelle Monae", "Many Moons", "Metropolis: The Chase Suite"); ' .

  'INSERT INTO Songs (so_id, so_artist, so_title, so_album) ' .
  'VALUES (1, "Fun.", "Some Nights", "Some Nights"); ' .

  'INSERT INTO Songs (so_id, so_artist, so_title, so_album) ' .
  'VALUES (2, "Fun.", "We Are Young", "Some Nights"); ' .

  'INSERT INTO Songs (so_id, so_artist, so_title, so_album) ' .
  'VALUES (3, "MIKA", "Love Today", "Life in Cartoon Motion"); ' .

  'INSERT INTO Songs (so_id, so_artist, so_title, so_album) ' .
  'VALUES (4, "Jessie J", "Domino", "Who You Are"); ';
  
if (!$database->exec($query)) {
  error_log("error: $error\n", 3, $logfile);
  die($error);
}

/*** CREATE THE Venues TABLE ***/
$query = 'CREATE TABLE Venues ' .
         '(ve_id INTEGER, ve_name TEXT, PRIMARY KEY (ve_id));';

if (!$database->exec($query)) {
  error_log("error: $error\n", 3, $logfile);
  die($error);
}

error_log("Venues table created\n", 3, $logfile);

/*** ADD DATA TO THE TABLE ***/
$query = 
  'INSERT INTO Venues (ve_id, ve_name) ' .
  'VALUES (0, "The Boom Boom Room"); ' .

  'INSERT INTO Venues (ve_id, ve_name) ' .
  'VALUES (1, "The Mallard"); ' .

  'INSERT INTO Venues (ve_id, ve_name) ' .
  'VALUES (2, "Chiman\'s Lounge"); ' .

  'INSERT INTO Venues (ve_id, ve_name) ' .
  'VALUES (3, "The Apollo"); ' .

  'INSERT INTO Venues (ve_id, ve_name) ' .
  'VALUES (4, "The Tilted Kilt"); ';
  
if (!$database->exec($query)) {
  error_log("error: $error\n", 3, $logfile);
  die($error);
}

/*** CREATE THE Queues TABLE ***/
$query = 'CREATE TABLE Queues ' .
         '(qu_id INTEGER, PRIMARY KEY (qu_id));';
// Will add 'date INTEGER' to the Queues table later

if (!$database->exec($query)) {
  error_log("error: $error\n", 3, $logfile);
  die($error);
}

error_log("Queues table created\n", 3, $logfile);

/*** ADD DATA TO THE TABLE ***/
// Test data: 5 djs, 5 queues
$query = 
  'INSERT INTO Queues (qu_id) ' .
  'VALUES (0); ' .

  'INSERT INTO Queues (qu_id) ' .
  'VALUES (1); ' .

  'INSERT INTO Queues (qu_id) ' .
  'VALUES (2); ' .

  'INSERT INTO Queues (qu_id) ' .
  'VALUES (3); ' .

  'INSERT INTO Queues (qu_id) ' .
  'VALUES (4); ';
  
if (!$database->exec($query)) {
  error_log("error: $error\n", 3, $logfile);
  die($error);
}


/// LOOKUP TABLES FOR THE QUEUE ///
// These tables relate Queues to Djs, and Songs to Queues

/*** CREATE THE QueueToDj TABLE ***/
$query = 'CREATE TABLE QueueToDj ' .
         '(qtd_queueId INTEGER, qtd_djId INTEGER, PRIMARY KEY (qtd_queueId, qtd_djId));';

if (!$database->exec($query)) {
  error_log("error: $error\n", 3, $logfile);
  die($error);
}

error_log("QueueToDj table created\n", 3, $logfile);

/*** ADD DATA TO THE TABLE ***/
// Test data: 5 djs, 5 queues
$query = 
  'INSERT INTO QueueToDj (qtd_queueId, qtd_djId) ' .
  'VALUES (0, 0); ' .

  'INSERT INTO QueueToDj (qtd_queueId, qtd_djId) ' .
  'VALUES (1, 1); ' .

  'INSERT INTO QueueToDj (qtd_queueId, qtd_djId) ' .
  'VALUES (2, 2); ' .

  'INSERT INTO QueueToDj (qtd_queueId, qtd_djId) ' .
  'VALUES (3, 3); ' .

  'INSERT INTO QueueToDj (qtd_queueId, qtd_djId) ' .
  'VALUES (4, 4); ';
  
if (!$database->exec($query)) {
  error_log("error: $error\n", 3, $logfile);
  die($error);
}

/*** CREATE THE QueueToVenue TABLE ***/
$query = 'CREATE TABLE QueueToVenue ' .
         '(qtv_queueId INTEGER, qtv_venueId INTEGER, PRIMARY KEY (qtv_queueId, qtv_venueId));';

if (!$database->exec($query)) {
  error_log("error: $error\n", 3, $logfile);
  die($error);
}

error_log("QueueToVenue table created\n", 3, $logfile);

/*** ADD DATA TO THE TABLE ***/
// Test data: 5 queues, 5 venues => 5 djs
$query = 
  'INSERT INTO QueueToVenue (qtv_queueId, qtv_venueId) ' .
  'VALUES (0, 0); ' .

  'INSERT INTO QueueToVenue (qtv_queueId, qtv_venueId) ' .
  'VALUES (1, 1); ' .

  'INSERT INTO QueueToVenue (qtv_queueId, qtv_venueId) ' .
  'VALUES (2, 2); ' .

  'INSERT INTO QueueToVenue (qtv_queueId, qtv_venueId) ' .
  'VALUES (3, 3); ' .

  'INSERT INTO QueueToVenue (qtv_queueId, qtv_venueId) ' .
  'VALUES (4, 4); ';
  
if (!$database->exec($query)) {
  error_log("error: $error\n", 3, $logfile);
  die($error);
}


/*** CREATE THE SongToQueue TABLE ***/
$query = 'CREATE TABLE SongToQueue ' .
         '(stq_songId INTEGER, stq_queueId INTEGER, stq_votes INTEGER, PRIMARY KEY (stq_songId, stq_queueId));';

if (!$database->exec($query)) {
  error_log("error: $error\n", 3, $logfile);
  die($error);
}

error_log("SongToQueue table created\n", 3, $logfile);

?>