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
*    fetchMovements.php
*    
*    Marc Harquail
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

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
    die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$sql = "SELECT extract(day from `time`) as day, SUM(CASE WHEN `movement`=1 THEN 1 ELSE 0 END) as 'movement' from SENSOR_$uid WHERE `time` >= DATE(NOW()) - INTERVAL 7 DAY GROUP BY extract(day from `time`)";

//execute query
$result = $mysqli->query($sql);

$counter = 0;

//loop through the returned data
$data = array();
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $data[] = $row;
	}
}

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
?>