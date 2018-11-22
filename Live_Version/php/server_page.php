<?php
	$servername = "107.180.27.180";
	$username = "MapleLeafAdmin";
	$password = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
	$content = file_get_contents("php://input");
	$data = json_decode($content);

	$uid = $data->uid;
	$msgType = $data->msgType;
	$vBat = $data->vbat;
	$temp = $data->temp;

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO SENSOR_0001203B (temp, movement)
	VALUES (".$temp.", 0)";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    error_log("Error: " . $sql . "<br>" . $conn->error,0);
	}

	$conn->close();
?>