<?php
	
	/*
		ArraysAtOne Capstone 2018 - Maple Leaf Foods

        Kevin Baumgartner
        Jesse Berube
        Marc Harquail
        Alex Ireland
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
	

	$id = $_POST["rowId"];
	$firstName = $_POST["first"];
	$lastName = $_POST["last"];
	$username = $_POST["user"];
	$password = $_POST["pass"];
	$status = $_POST["stat"];
	$functionName = $_POST["functionName"];

	
	if($functionName == "DeleteRow")
	{
		DeleteRow($id, $conn);
	}
	else if($functionName == "AddRow")
	{
		AddRow($firstName, $lastName, $username, $password, $status, $conn);
	}
	else if($functionName == "UpdateRow")
	{
		UpdateRow($id, $firstName, $lastName, $username, $status, $conn);
	}

	function DeleteRow($id, $conn){
		
	$sql = 'DELETE FROM UserTable WHERE id="'.$id.'"';

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}

		$conn->close();
	}
	
	function AddRow($firstName, $lastName, $username, $password, $status, $conn){
		

	$sql = $conn->prepare('INSERT INTO UserTable (FirstName, lastName, Username, Password, Status) VALUES (?, ?, ?, ?, ?)');
	$sql->bind_Param("sssss", $firstName, $lastName, $username, $password, $status);

		if ($sql->execute() === TRUE) {
			echo mysqli_insert_id($conn);
		} else {
			echo "Error updating record: " . $sql->error;
		}

		$sql->close();
	}
	
	function UpdateRow($id, $firstName, $lastName, $username, $status, $conn){
		
	
	$sql = $conn->prepare('UPDATE UserTable SET FirstName = ?, lastName = ?, Username = ?, Status = ? WHERE id="'.$id.'"');
	$sql->bind_Param("ssss", $firstName, $lastName, $username, $status);

		if ($sql->execute() === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $sql->error;
		}

		$sql->close();
	}
?>