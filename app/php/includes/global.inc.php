<?php

require_once './../classes/User.class.php';
require_once '../classes/UserTools.class.php';
require_once '../classes/SQLite.class.php';

// connect to the database
$db = new SQLite();
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