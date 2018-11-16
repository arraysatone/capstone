<?php
	$servername = "142.55.32.48";
	$username = "harquaim_php";
	$password = "c@pstone_server";
	$dbname = "harquaim_capstone";
	$content = file_get_contents("php://input");
	$data = json_decode($content);

	$uid = $data->uid;

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO sensor2 (uid)
	VALUES ('".$uid."')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    error_log("Error: " . $sql . "<br>" . $conn->error,0);
	}

	$conn->close();
?>