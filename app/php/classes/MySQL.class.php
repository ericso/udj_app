<?php  
// MySQL.class.php
// This class handles database connections for MySQL databases

require_once 'Logger.class.php';

class MySQL {  
    protected $db_name;
    protected $db_user;
    protected $db_pass;
    protected $db_host;

    function __construct($name, $user, $pass, $host='localhost') {
        $this->db_name = $name;
        $this->db_user = $user;
        $this->db_pass = $pass;
        $this->db_host = $host;

        // setup logging
        $this->logger = new Logger('mysql.log');
    }

    //open a connection to the database. Make sure this is called  
    //on every page that needs to use the database. 
    public function connect() {
        $this->logger->log('about to make a MySQL connection', 3);

        $connection = mysql_connect($this->db_host, $this->db_user, $this->db_pass);  
        mysql_select_db($this->db_name);

        return true;
    }

    // takes a mysql row set and returns an associative array, where the keys  
    // in the array are the column names in the row set. If singleRow is set to  
    // true, then it will return a single row instead of an array of rows.  
    public function processRowSet($rowSet, $singleRow=false) {
        $this->logger->log('about to process a row set', 3);

        $resultArray = array();  
        while ($row = mysql_fetch_assoc($rowSet)) {
            $this->logger->log('about to push a row onto the array', 3);
            array_push($resultArray, $row);
        }
  
        if ($singleRow === true) {
            $this->logger->log('single row, returning', 3);
            return $resultArray[0];
        }

        $this->logger->log('multiple rows, returning', 3);
        return $resultArray;  
    }  
  
    // Select rows from the database.  
    // returns a full row or rows from $table using $where as the where clause.  
    // return value is an associative array with column names as keys.
    // if no rows returned, returns false
    public function select($table, $where, $data='*') {
        $this->logger->log('about to make a MySQL SELECT call', 3);

        if ($data == '*') {
            $columns = '*';
        } else {
            $columns = "";

            foreach ($data as $column) {
                $columns .= ($columns == "") ? "" : ", ";
                $columns .= $column;
            }
        }

        $sql = "SELECT $columns FROM $table WHERE $where";
        $result = mysql_query($sql);

        if ($result == false) {
            return false;
        }

        if (mysql_num_rows($result) == 1) {
            $this->logger->log('MySQL SELECT call found a single row', 3);
            return $this->processRowSet($result, true);
        }
        $this->logger->log('MySQL SELECT call found multiple rows', 3);
        return $this->processRowSet($result);
    }

    // Updates a current row in the database.  
    // takes an array of data, where the keys in the array are the column names  
    // and the values are the data that will be inserted into those columns.  
    // $table is the name of the table and $where is the sql where clause.
    public function update($data, $table, $where) {
        foreach ($data as $column => $value) {
            $sql = "UPDATE $table SET $column = $value WHERE $where";  
            mysql_query($sql) or die(mysql_error());
        }
        return true;
    }  
  
    // Inserts a new row into the database.  
    // takes an array of data, where the keys in the array are the column names  
    // and the values are the data that will be inserted into those columns.  
    // $table is the name of the table.  
    public function insert($data, $table) {
        $columns = "";
        $values = "";

        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column;
            $values .= ($values == "") ? "" : ", ";
            $values .= $value;
        }

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        mysql_query($sql) or die(mysql_error());

        // return the ID of the user in the database.  
        return mysql_insert_id();
    }

    // Removes a row in the database.
    // Takes a table and a where clause and removes the row(s) matching
    // $table is the name of the table and $where is the sql where clause.
    public function remove($table, $where) {
        foreach ($data as $column => $value) {
            $sql = "DELETE FROM $table WHERE $where";
            mysql_query($sql) or die(mysql_error());
        }
        return true;
    }

    // Sends a generic query to the database.
    // takes a query string and executes it
    public function query($query_text) {
        // TODO: clean query text
        $result = mysql_query($query_text);
        if ($result == false)  {
            return false;
        } elseif (mysql_num_rows($result) == 1) {
            return $this->processRowSet($result, true);  
        }
        return $this->processRowSet($result);        
    }
}
  
?>