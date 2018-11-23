<?php
	$servername = "107.180.27.180";
	$username = "MapleLeafAdmin";
	$password = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
	$id = $_POST["id"];
	$functionName = $_POST["functionName"];



	$conn = new mysqli($servername, $username, $password, $dbname);
	  // Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	} 
	
	if($functionName == "DeleteRow")
	{
		DeleteRow($conn, $id);
	}

	function DeleteRow($conn, $id){
	$sql = "DELETE FROM EMAIL_LIST WHERE id='".$id."'";

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}

		$conn->close();
	}
?>