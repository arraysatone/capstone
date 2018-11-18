<?php

	$servername = "107.180.27.180";
	$username = "MapleLeafAdmin";
	$password = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM SENSORS";
	$counter = 0;

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$arr = array();
		while($row = $result->fetch_assoc()) {
			$uid = $row['uid'];
			$sensorThresh = doubleval($row['threshold']);
			$sqlTemp = "SELECT `temp`, `movement`, `time` FROM SENSOR_$uid WHERE time=(SELECT MAX(time) FROM SENSOR_$uid)";
			$sensorData = $conn->query($sqlTemp);
			$curtime = time();
			if($sensorData->num_rows > 0){
				while($innerRow = $sensorData->fetch_assoc()){
					$sensorTemp = doubleval($innerRow['temp']);
					$sensorMovement = $innerRow['movement'];
					$sensorTime = $innerRow['time'];
					if($sensorTemp >= $sensorThresh){
						if($sensorMovement && (($curtime - $sensorTime) <= 10)){
							$status = 4;
						}
						else{
							$status = 2;
						}
					}
					elseif($sensorMovement && (($curtime - $sensorTime) <= 10)){
						$status = 3;
					}
					else{
						$status = 1;
					}
				}
				$arr["sensors"][$counter]['uid'] = $uid;
				$arr["sensors"][$counter]['temp'] = substr($sensorTemp, 0, 2);
				$arr["sensors"][$counter]['move'] = $sensorMovement;
				$arr["sensors"][$counter]['status'] = $status; 
				$counter = $counter + 1;
			}
			else{
				$counter = $counter + 1;
			}
		}
		echo json_encode($arr);
	}
	else {
		echo "0 results";
	}
	$conn->close();

?>