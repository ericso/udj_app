<?php
// Logger.class.php

require_once 'SQLite.class.php';

class User {
	protected $log_directory = '../../logs/';
    protected $log_file = $log_directory . 'database.log';

	error_log("---------------------------------\n", 3, $logfile);
	error_log("start: create_db.php\n", 3, $logfile);
}