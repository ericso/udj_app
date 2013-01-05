<?php
// Logger.class.php
// this class handlings writing to logs

class Logger {
	// the path to the log directory and files
	protected $log_directory;
    protected $log_file;

    function __construct($file) {
    	$this->log_directory = __DIR__ . "/../../../logs/";
    	$this->log_file = $this->log_directory . $file;
    }

    public function log($data, $level) {
		error_log($data . " \n", $level, $this->log_file);
    }
}

?>