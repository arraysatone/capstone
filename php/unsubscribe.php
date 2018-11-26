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
	*    unsubscribe.php
	*    
	*    Marc Harquail
	*
	*/
	$servername = "107.180.27.180";
	$username = "MapleLeafAdmin";
	$password = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
	$uid = $_SESSION['uid'];


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
	}
	else{
		$sql = "SELECT * FROM RememberMe WHERE Cookie='".session_id()."' LIMIT 1";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				$user = $row['ForeignID'];
			}
		}
		$conn->close();
	}


	$conn = new mysqli($servername, $username, $password, $dbname);
	$emailSQL = "SELECT id FROM EMAIL_LIST WHERE userAccount = '".$user."'";
	$sqlResult = $conn->query($emailSQL);
	if ($sqlResult->num_rows > 0) {
		while($row = $sqlResult->fetch_assoc()){
			$id = $row['id'];
			$unsubSQL = "DELETE FROM `SUB_STATUS` WHERE `userId` = ".$id." AND `uid` = '".$uid."' ";
			$unsubResult = $conn->query($unsubSQL);

			if ($unsubResult) {
				echo "unsubbed";
			}
			else {
				echo mysqli_error($conn);
			}
		}
	}
	$conn->close();
?>