<?php
// global.inc.php

require_once(dirname(__FILE__) . '/../classes/User.class.php');
require_once(dirname(__FILE__) . '/../classes/UserTools.class.php');
require_once(dirname(__FILE__) . '/../classes/SQLite.class.php');
require_once(dirname(__FILE__) . '/../classes/Logger.class.php');

// create a logger
$logger = new Logger('php.log');

// connect to the database, pass in the name of the database
$db = new SQLite('request.sqlite');
$db->connect();
  
// initialize UserTools object
$userTools = new UserTools();

// start the session
session_start();
$logger->log("Session started", 3);

// refresh session variables if logged in
if (isset($_SESSION['logged_in'])) {
    $user = unserialize($_SESSION['user']);
    $_SESSION['user'] = serialize($userTools->get($user->id));
}

?>