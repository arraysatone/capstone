<?php

	session_start();
	
	$dbservername = "107.180.27.180";
	$dbusername = "MapleLeafAdmin";
	$dbpassword = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
	$loggedin = false;
	
	
	$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	if(isset($_COOKIE['LoginKey'])) {
		$sql = "DELETE FROM RememberMe WHERE Cookie='".$_COOKIE['LoginKey']."'";
		$result = $conn->query($sql);
		unset($_COOKIE['LoginKey']);
		setcookie('LoginKey', null, -1, '/');
		
		if ($result->num_rows > 0) {
		// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "Deletion successful";
				
				
			}
		}
		
		
	}else{
		$sql = "DELETE FROM RememberMe WHERE Cookie='".session_id()."'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		// output data of each row
			while($row = $result->fetch_assoc()) {
				echo 'Deletion successful';
			}
		}
		
	}

	header('Location: /');
	

?>