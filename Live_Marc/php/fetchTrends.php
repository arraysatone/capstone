<?php
session_start();
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', '107.180.27.180');
define('DB_USERNAME', 'MapleLeafAdmin');
define('DB_PASSWORD', 'ClVq0Qzt21jz');
define('DB_NAME', 'Mapleleaf_Capstone');
$uid = $_SESSION['uid'];

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
    die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = "SELECT temp, `time` FROM (SELECT * FROM SENSOR_$uid ORDER BY `time` DESC LIMIT 5) tm ORDER BY `time` ASC";

//execute query
$result = $mysqli->query($query);

$counter = 0;

//loop through the returned data
$data = array();
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $data[] = $row;
	    $hold = $row['time'];
	    $data[$counter]['time'] = substr($hold,11,5);
	    $counter = $counter + 1;
	}
}

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
?>