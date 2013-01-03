<?php

// UserTools.class.php
// contains functions relating to users

require_once 'User.class.php';
require_once 'SQLite.class.php';

class UserTools {
    // Log the user in. First checks to see if the
    // username and password match a row in the database.
    // If it is successful, set the session variables
    // and store the user object within.
    // $result is an array of the returned rows as key-value pairs
    public function login($username, $password) {  
  
        $hashedPassword = md5($password);
        $result = select('Users', "username = '$username' AND password = '$hashedPassword'");

        if (count($result) == 1) {
            $_SESSION["user"] = serialize(new User($result));
            $_SESSION["login_time"] = time();
            $_SESSION["logged_in"] = 1;
            return true;
        } else {
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
        $result = select('Users', "username = '$username'", 'id')
        
        if (count($result) == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    // Get a user
    // returns a User object. Takes the users id as an input
    public function get($id) {  
        $db = new SQLite();  
        $result = $db->select('Users', "id = $id");  
          
        return new User($result);
    }
}

?>