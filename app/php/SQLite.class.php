<?php
// SQLite.class.php
// This class handles database connections for SQLite3 databases

class SQLite {  
    protected $db_name = 'request.sqlite';
    protected $db_path = '../../databases/';

    //open a connection to the database. Make sure this is called
    //on every page that needs to use the database.
    public function connect() {
        try {
            // Create or open the database
            $db = new SQLite3($this->db_path . $this->db_name);
        } catch (Exception $e) {
            die ($error);
        }
        return true;
    }

    // takes a mysql row set and returns an associative array, where the keys  
    // in the array are the column names in the row set. If singleRow is set to  
    // true, then it will return a single row instead of an array of rows.  
    public function processRowSet($rowSet, $singleRow=false) {  
        $resultArray = array();  
        while ($row = $rowSet->fetchArray*()) {  
            array_push($resultArray, $row);  
        }  
  
        if ($singleRow === true) { 
            return $resultArray[0];
        } else {
            return $resultArray;  
        }
    }

    // Select rows from the database. 
    // returns a full row or rows from $table using $where as the where clause.  
    // return value is an associative array with column names as keys.  
    public function select($table, $where, $data='*') {
        if ($data === '*') {
            $columns = '*';
        } else {
            $columns = "";

            foreach ($data as $column) {
                $columns .= ($columns == "") ? "" : ", ";
                $columns .= $column;
            }
        }

        $sql = "SELECT $columns FROM $table WHERE $where";  
        $result = $db->query($sql);

        if ($result->numRows() == 1) {
            return $this->processRowSet($result, true);  
        } else {
            return $this->processRowSet($result);
        }
    }
  
    // Updates a current row in the database.  
    // takes an array of data, where the keys in the array are the column names  
    // and the values are the data that will be inserted into those columns.  
    // $table is the name of the table and $where is the sql where clause.  
    public function update($data, $table, $where) {
        foreach ($data as $column => $value) {
            $sql = "UPDATE $table SET $column = $value WHERE $where";
            $db->query($sql) or die($db->lastErrorMsg());
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
  
        $db->query($sql) or die($db->lastErrorMsg());
  
        //return the ID of the user in the database.  
        return lastInsertRowID();
    }

    // Removes a row in the database.
    // Takes a table and a where clause and removes the row(s) matching
    // $table is the name of the table and $where is the sql where clause.
    public function remove($table, $where) {
        foreach ($data as $column => $value) {
            $sql = "DELETE FROM $table WHERE $where";
            $db->query($sql) or die($db->lastErrorMsg());
        }
        return true;
    }

    // Sends a generic query to the database.
    // takes a query string and executes it
    public function select($query_text) {
        $result = $db->query($query_text);
        if ($result->numRows() == 1) {
            return $this->processRowSet($result, true);  
        } else {
            return $this->processRowSet($result);
        }
    }
}

?>