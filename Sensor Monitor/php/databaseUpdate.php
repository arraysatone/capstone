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
	*    databaseUpdate.php
	*    
	*    Jesse Berube
	*
	*/
	$id = $_POST["id"];
	$firstName = $_POST["first"];
	$lastName = $_POST["last"];
	$userName = $_POST["user"];
	$email = $_POST["email"];
	$functionName = $_POST["functionName"];

	
	if($functionName == "DeleteRow")
	{
		DeleteRow($id);
	}
	else if($functionName == "AddRow")
	{
		AddRow($firstName, $lastName, $userName, $email);
	}
	else if($functionName == "UpdateRow")
	{
		UpdateRow($id, $firstName, $lastName, $userName, $email);
	}

	function DeleteRow($id){
		
	$servername = "107.180.27.180";
	$username = "MapleLeafAdmin";
	$password = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	  // Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	} 
	
	$sql = 'DELETE FROM EMAIL_LIST WHERE id="'.$id.'"';

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}

		$conn->close();
	}
	
	function AddRow($firstName, $lastName, $userName, $email){
		
	$servername = "107.180.27.180";
	$username = "MapleLeafAdmin";
	$password = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	  // Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	} 
	
	$sql = $conn->prepare('INSERT INTO EMAIL_LIST (firstName, lastName, username, email) VALUES (?, ?, ?, ?)');
	$sql->bind_Param("ssss", $firstName, $lastName, $userName, $email);

		if ($sql->execute() === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $sql->error;
		}

		$sql->close();
	}
	
	function UpdateRow($id, $firstName, $lastName, $userName, $email){
		
	$servername = "107.180.27.180";
	$username = "MapleLeafAdmin";
	$password = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	  // Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	} 
	
	$sql = $conn->prepare('UPDATE EMAIL_LIST SET firstName = ?, lastName = ?, username = ?, email = ?  WHERE id="'.$id.'"');
	$sql->bind_Param("ssss", $firstName, $lastName, $userName, $email);

		if ($sql->execute() === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $sql->error;
		}

		$sql->close();
	}
?>