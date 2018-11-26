<?php
	session_start();
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
	*    indexCheckSub.php
	*    
	*    Marc Harquail
	*
	*/
	$servername = "107.180.27.180";
	$username = "MapleLeafAdmin";
	$password = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
	$uid = $_GET['uid'];


	$conn = new mysqli($servername, $username, $password, $dbname);
	    // Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	if(isset($_COOKIE['LoginKey'])) {
		$sql = "SELECT * FROM RememberMe WHERE Cookie='".$_COOKIE['LoginKey']."' LIMIT 1";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				$user = $row['ForeignID'];
			}
		}
		else{
			echo("no user from check sub");
		}
	}
	else{
		$sql = "SELECT * FROM RememberMe WHERE Cookie='".session_id()."' LIMIT 1";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				$user = $row['ForeignID'];
			}
		}
		else{
			echo("no user from check sub");
		}
		$conn->close();
	}

	$conn = new mysqli($servername, $username, $password, $dbname);

	$emailSQL = "SELECT id FROM EMAIL_LIST WHERE userAccount = ".$user."";
	$emailResult = $conn->query($emailSQL);
	if($emailResult->num_rows > 0){
		while($emailRow = $emailResult->fetch_assoc()){
			$id = $emailRow['id'];
			$subSQL = "SELECT * FROM SUB_STATUS WHERE uid = '$uid' AND userID = ".$id."";
			$subResult = $conn->query($subSQL);
			if ($subResult->num_rows > 0) {
				echo 1;
			}
			else {
				echo 0;
			}
		}
	}
	$conn->close();
?>