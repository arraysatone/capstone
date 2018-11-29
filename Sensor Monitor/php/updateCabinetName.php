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
*    updateCabinetName.php
*    
*    Marc Harquail
*
*/
	
	$servername = "107.180.27.180";
	$username = "MapleLeafAdmin";
	$password = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	  // Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$uid = $_GET['uid'];
	$name = $_GET['name'];
	
	$sql = $conn->prepare('UPDATE CABINETS SET cabinetName = ? WHERE cabinetName = (SELECT cabinetName FROM LOCATION_SENSORS WHERE uid = "'.$uid.'")');
	$sql->bind_Param("s", $name);

	if ($sql->execute() === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $sql->error;
	}

	$sql->close();
?>