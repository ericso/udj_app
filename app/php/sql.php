<?php
//phpinfo();
$logfile = "..\\..\\logs\\sql.log";
error_log("start\n", 3, $logfile);


try 
{
  //create or open the database
  $database = new SQLiteDatabase('../../databases/archive.db', 0666, $error);
  //error_log("db $database\n", 3, $logfile);
}
catch(Exception $e) 
{
  
  error_log("error: $e\n", 3, $logfile);
  error_log("error: $error\n", 3, $logfile);
  die($error);
}
/*
$query = 'CREATE TABLE Events ' .
         '(WavTime INTEGER, Time INTEGER, Event TEXT, Wav TEXT, Location TEXT, PRIMARY KEY (Time, Event, Wav))';
         
if(!$database->queryExec($query, $error))
{
  error_log("error: $error\n", 3, $logfile);
 die($error);
}

$query = 
  'INSERT INTO Events (WavTime, Time, Event, Wav, Location) ' .
  'VALUES (30, 1353350974, "gunshot", "asdf.wav", "Ifigeneia\'s Desk"); ' .
         
 'INSERT INTO Events (WavTime, Time, Event, Wav, Location) ' .
  'VALUES (12, 1290192573, "gunshot", "asdf1.wav", "Trevor\'s Desk"); ' .
         
  'INSERT INTO Events (WavTime, Time, Event, Wav, Location) ' .
  'VALUES (3, 1321728573, "alarm", "asdf.wav", "Ifigeneia\'s Desk"); ';
  
if(!$database->queryExec($query, $error))
{
   error_log("error: $error\n", 3, $logfile);
   die($error);
}





*/

//read data from database
/*$query = "SELECT * FROM Events";
if($result = $database->query($query, SQLITE_BOTH, $error))
{
  while($row = $result->fetch())
  {
    print("WavTime: {$row['WavTime']} <br />" .
          "Time: {$row['Time']} <br />".
          "Event: {$row['Event']} <br />".
          "Wav: {$row['Wav']} <br />".
          "Location: {$row['Location']} <br /><br />");
  }
}
else
{
  error_log("error: $error\n", 3, $logfile);
  die($error);
}  */
 
 //read data from database
$query = "SELECT DISTINCT Event FROM Events";
if($result = $database->query($query, SQLITE_BOTH, $error))
{
  while($row = $result->fetch())
  {
    print("Event: {$row['Event']} <br /><br />");
  }
}
else
{
  error_log("error: $error\n", 3, $logfile);
  die($error);
}  
 
$query = 
  //'DELETE FROM Events WHERE location IN (\'Line-in Mic\',\'ifigeneia\'\'s desk\'); ';
  'DELETE FROM Events WHERE wav IN (\'sssRecorderWav1354195485899.wav\',\'ifigeneia\'\'s desk\'); ';
  //'DELETE FROM Events WHERE event IN (\'alarm2mono\',\'ifigeneia\'\'s desk\'); ';
  
if(!$database->queryExec($query, $error))
{
   error_log("error: $error\n", 3, $logfile);
   die($error);
}

 //read data from database
$query = "SELECT DISTINCT Location FROM Events";
if($result = $database->query($query, SQLITE_BOTH, $error))
{
  while($row = $result->fetch())
  {
    print("Location: {$row['Location']} <br /><br />");
  }
}
else
{
  error_log("error: $error\n", 3, $logfile);
  die($error);
}  
 
 //read data from database
$query = "SELECT DISTINCT wav FROM Events";
if($result = $database->query($query, SQLITE_BOTH, $error))
{
  while($row = $result->fetch())
  {
    print("wav: {$row['wav']} <br /><br />");
  }
}
else
{
  error_log("error: $error\n", 3, $logfile);
  die($error);
}  
error_log("end\n", 3, $logfile);
?>