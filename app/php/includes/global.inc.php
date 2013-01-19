<?php
// global.inc.php

require_once(dirname(__FILE__) . '/../classes/User.class.php');
require_once(dirname(__FILE__) . '/../classes/UserTools.class.php');
require_once(dirname(__FILE__) . '/../classes/SQLite.class.php');
require_once(dirname(__FILE__) . '/../classes/MySQL.class.php');
require_once(dirname(__FILE__) . '/../classes/Logger.class.php');

// create a logger
$logger = new Logger('php.log');

// connect to the SQLite database
// $db = new SQLite('request.sqlite');
// $db->connect();

// connect to the MySQL database
$db = new MySQL('request', 'request', 'R66teeeeeeeeeeeeeee', 'localhost');
$db->connect();

// initialize UserTools object
$userTools = new UserTools();

// start the session
session_start();

// refresh session variables if logged in
if (isset($_SESSION['logged_in'])) {
    $user = unserialize($_SESSION['user']);
    $_SESSION['user'] = serialize($userTools->get($user->id));
}

?>