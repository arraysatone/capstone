<?php

/*
*    ArraysAtOne Capstone 2018 - Maple Leaf Foods
*
*    Kevin Baumgartner
*    Jesse Berube
*    Marc Harquail
*    Alex Ireland
*
* * * * * * * * * * * * * * * * * * * * * * * * *
*
*    fetchTrends.php
*    
*    Kevin Baumgartner
*
*/

//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', '107.180.27.180');
define('DB_USERNAME', 'MapleLeafAdmin');
define('DB_PASSWORD', 'ClVq0Qzt21jz');
define('DB_NAME', 'Mapleleaf_Capstone');
$uid = $_GET['uid'];
$before = $_GET['before'];
$after = $_GET['after'];

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
    die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = "SELECT AVG(`temp`) as temp, extract(day from `time`) as day FROM SENSOR_0001203B WHERE time BETWEEN '$before' AND '$after' GROUP BY extract(day from `time`)";

//execute query
$result = $mysqli->query($query);

$counter = 0;

//loop through the returned data
$data = array();
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $data[$counter]['temp'] = $row['temp'];
	    $data[$counter]['time'] = $row['day'];
	    $counter = $counter + 1;
	}
}

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
//echo $before." ".$after;
?>