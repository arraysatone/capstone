<?php
  	session_start();
	$servername = "107.180.27.180";
	$username = "MapleLeafAdmin";
	$password = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
  	$uid = $_SESSION['uid'];

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$getThresh = "SELECT threshold FROM SENSORS WHERE uid = '".$uid."'";
	$result = $conn->query($getThresh);

	if ($result->num_rows > 0) {
		$arr = array();
		while($row = $result->fetch_assoc()) {
			$thresh = $row['threshold'];
			$getTempWeek = "SELECT COUNT(temp) as tempe FROM SENSOR_$uid WHERE temp > $thresh AND time > DATE(NOW()) - INTERVAL 1 WEEK";
			$tempWeek = $conn->query($getTempWeek);
			$getTempMonth = "SELECT COUNT(temp) as tempe FROM SENSOR_$uid WHERE temp > $thresh AND time > DATE(NOW()) - INTERVAL 1 MONTH";
			$tempMonth = $conn->query($getTempMonth);
			$getTempYear = "SELECT COUNT(temp) as tempe FROM SENSOR_$uid WHERE temp > $thresh AND time > DATE(NOW()) - INTERVAL 1 YEAR";
			$tempYear = $conn->query($getTempYear);

			$getAccelWeek = "SELECT COUNT(movement) as move FROM SENSOR_$uid WHERE movement = 1 AND time > DATE(NOW()) - INTERVAL 1 WEEK";
			$accelWeek = $conn->query($getAccelWeek);
			$getAccelMonth = "SELECT COUNT(movement) as move FROM SENSOR_$uid WHERE movement = 1 AND time > DATE(NOW()) - INTERVAL 1 MONTH";
			$accelMonth = $conn->query($getAccelMonth);
			$getAccelYear = "SELECT COUNT(movement) as move FROM SENSOR_$uid WHERE movement = 1 AND time > DATE(NOW()) - INTERVAL 1 YEAR";
			$accelYear = $conn->query($getAccelYear);

			if($tempWeek && $tempMonth && $tempYear && $accelWeek && $accelMonth && $accelYear){
				$tWeek = $tempWeek->fetch_assoc();
				$tMonth = $tempMonth->fetch_assoc();
				$tYear = $tempYear->fetch_assoc();

				$aWeek = $accelWeek->fetch_assoc();
				$aMonth = $accelMonth->fetch_assoc();
				$aYear = $accelYear->fetch_assoc();
				
				$arr["events"][0]['week'] = $tWeek['tempe'];
				$arr["events"][0]['month'] = $tMonth['tempe'];
				$arr["events"][0]['year'] = $tYear['tempe'];

				$arr["events"][1]['week'] = $aWeek['move'];
				$arr["events"][1]['month'] = $aMonth['move'];
				$arr["events"][1]['year'] = $aYear['move'];
			}
			else{
				echo "error";
			}
		}
		echo json_encode($arr);
	}
	else {
		echo "0 results";
	}
	$conn->close();

?>