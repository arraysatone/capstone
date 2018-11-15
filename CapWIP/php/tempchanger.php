<?php
	$servername = "107.180.27.180";
	$username = "MapleLeafAdmin";
	$password = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
	$temp = $_POST["temp"];
	echo $temp;


	$conn = new mysqli($servername, $username, $password, $dbname);
	  // Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	} 


	$sql = "UPDATE SENSORS SET threshold='".$temp."' WHERE uid='0001203B'";

	if ($conn->query($sql) === TRUE) {
	    echo "Record updated successfully";
	} else {
	    echo "Error updating record: " . $conn->error;
	}

	$conn->close();
?>