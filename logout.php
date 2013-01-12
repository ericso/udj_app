<?php
//logout.php
require_once 'app/php/includes/global.inc.php';

$userTools = new UserTools();
$userTools->logout();

header("Location: index.php");

?>