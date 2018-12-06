<?php
session_start();
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
*    temp_select.php
*    
*	   Marc Harquail
*
*/
$uid = $_GET['uid'];

include './connectionInfo.php';

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 
$arr = array();
$sql = "SELECT `temp`, `movement`, `time` FROM SENSOR_$uid WHERE `time`=(SELECT MAX(`time`) FROM SENSOR_$uid)";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
      // output data of each row
	while($row = $result->fetch_assoc()) {
		$sqlThresh = "SELECT threshold FROM SENSORS WHERE uid = '".$uid."'";
		$thresh = $conn->query($sqlThresh);
		if($thresh->num_rows > 0){
			while($innerRow = $thresh->fetch_assoc()){
				$arr['status'] = "success";
				$arr['temp'] = $row['temp'];
				$arr['move'] = $row['movement'];
				$arr['time'] = $row['time'];
				$arr['thresh'] = $innerRow['threshold'];
			}
		}
		else{
			$arr['status'] = "failure";
		}
	}
}
else {
	$arr['status'] = "failure";
}
$conn->close();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$uid = $_GET['uid'];

$maxTemp = "SELECT MAX(`temp`) as maxTemp, MIN(`temp`) as minTemp FROM SENSOR_$uid WHERE `time` > DATE_SUB(NOW(), INTERVAL 24 HOUR)";

$maxResult = $conn->query($maxTemp);

//Print data for max and temp of last 24 hours
while($row = $maxResult->fetch_assoc()) {
	if (is_null($row['maxTemp'])) {
		$arr['maxStatus'] = "failure";
	}
	else{
		$arr['maxStatus'] = "success";
		$arr['maxTemp'] = $row['maxTemp'];
		$arr['minTemp'] = $row['minTemp'];
	}
}

echo json_encode($arr);

$conn->close();

?>