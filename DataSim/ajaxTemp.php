<?php
	$servername = "142.55.32.48";
	$username = "harquaim_php";
	$password = "c@pstone_server";
	$dbname = "harquaim_capstone";
	$data = $_POST["q"];

	$uid = "0001203B";
	$msgType = "1";
	$vBat = "3132";
	$temp = $data;

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO Sensor (uid, msgType, vBat, temp)
	VALUES ('".$uid."', ".$msgType.", ".$vBat.", ".$temp.")";

	if ($conn->query($sql) === TRUE) {
	    echo "Temp Insert Successful";
	} else {
	    error_log("Error: " . $sql . "<br>" . $conn->error,0);
	}

	$conn->close();
?>