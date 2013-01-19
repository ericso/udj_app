<?php

// UserTools.class.php
// contains functions relating to users

//require_once './../includes/global.inc.php';

require_once 'User.class.php';
require_once 'MySQL.class.php';
require_once 'Logger.class.php';

class UserTools {
    // Log the user in. First checks to see if the
    // username and password match a row in the database.
    // If it is successful, set the session variables
    // and store the user object within.
    // $result is an array of the returned rows as key-value pairs


    function __construct() {
        // setup the logger
        $this->logger = new Logger('php.log');

        // connect to the database
        $this->db = new MySQL('request', 'request', 'R66teeeeeeeeeeeeeee', 'localhost');
        $this->db->connect();
    }

    public function login($username, $password) {  
        $this->logger->log('about to log in user', 3);

        $hashedPassword = md5($password);
        //$result = $db->select('Users', "username = '$username' AND password = '$hashedPassword'");
        $result = $this->db->select("Users", "us_username = '$username' AND us_password = '$hashedPassword'");
        
        $this->logger->log('in result: ' . print_r($result, true), 3);

        // this means there were no records returned
        // if ($result == false) {
        //     $this->logger->log('unable to log in user, no user found', 3);
        //     return;
        // }

        if (count($result) != 0) {
        //if (mysql_num_rows($result) == 1) {
            $this->logger->log('found a user, setting session variables', 3);

            $_SESSION["user"] = serialize(new User($result));
            $_SESSION["login_time"] = time();
            $_SESSION["logged_in"] = 1;
            return true;
        } else {
            $this->logger->log('unable to log in user, no user found', 3);
            return false;
        }
    }
    
    // Log the user out. Destroy the session variables.  
    public function logout() {
        unset($_SESSION['user']);
        unset($_SESSION['login_time']);
        unset($_SESSION['logged_in']);
        session_destroy();
    }

    // Check to see if a username exists.
    // This is called during registration to make sure all user names are unique.
    public function checkUsernameExists($username) {
        $result = $this->db->select('Users', "us_username = '$username'", ['us_id']);
        //$result = mysql_query("SELECT 'us_id' FROM Users WHERE username = '$username'");

        // if ($result == false) {
        //     $this->logger->log('In checkUsernameExists: no found user', 3);
        //     return false;
        // }

        if (count($result) == 0) {
            $this->logger->log('In checkUsernameExists: no found user', 3);
            return false;
        } else {
            $this->logger->log('In checkUsernameExists: found a user', 3);
            return true;
        }
    }
    
    // Get a user
    // returns a User object. Takes the users id as an input
    public function get($id) {
        $result = $this->db->select('Users', "us_id = $id");  
        
        return new User($result);
    }
}

?>