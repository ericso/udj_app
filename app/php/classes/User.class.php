<?php
// User.class.php
  
require_once 'MySQL.class.php';

class User {
    public $id;
    public $username;
    public $hashedPassword;
    public $email;
    public $joinDate;
  
    // Constructor is called whenever a new object is created.
    // Takes an associative array with the SQLite row as an argument.
    function __construct($data) {
        $this->id = (isset($data['us_id'])) ? $data['us_id'] : "";
        $this->username = (isset($data['us_username'])) ? $data['us_username'] : "";
        $this->hashedPassword = (isset($data['us_password'])) ? $data['us_password'] : "";
        $this->email = (isset($data['us_email'])) ? $data['us_email'] : "";
        $this->joinDate = (isset($data['us_join_date'])) ? $data['us_join_date'] : "";
    }
    
    public function save($isNewUser = false) {
        // create a new database object.
        $db = new MySQL('request', 'requestuser', 'R66teeeeeeeeeeeeeee', 'localhost');
        $db->connect();
          
        // if the user is already registered and we're just updating their info.  
        if (!$isNewUser) {
            //set the data array
            $data = array(
                "us_username" => "'$this->username'",
                "us_password" => "'$this->hashedPassword'",
                "us_email" => "'$this->email'"
            );
            
            // update the row in the database
            $db->update($data, 'Users', 'us_id = ' . $this->id);
        } else {
        // if the user is being registered for the first time.
            $data = array(
                "us_username" => "'$this->username'",
                "us_password" => "'$this->hashedPassword'",
                "us_email" => "'$this->email'",
                "us_join_date" => "'" . date("Y-m-d H:i:s",time()) . "'" 
            );
            
            $this->id = $db->insert($data, 'Users');
            $this->joinDate = time();
        }
        return true;  
    }
}
  
?>