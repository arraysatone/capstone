<?php

//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', '107.180.27.180');
define('DB_USERNAME', 'MapleLeafAdmin');
define('DB_PASSWORD', 'ClVq0Qzt21jz');
define('DB_NAME', 'Mapleleaf_Capstone');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
    die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf("SELECT temp, `time` FROM (SELECT * FROM SENSOR_0001203B ORDER BY `time` DESC LIMIT 5) tm ORDER BY `time` ASC");

//execute query
$result = $mysqli->query($query);

$counter = 0;

//loop through the returned data
$data = array();
foreach ($result as $row) {
    $data[] = $row;
    $hold = $row[time];
    $data[$counter][time] = substr($hold,11,5);
    $counter = $counter + 1;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
?>