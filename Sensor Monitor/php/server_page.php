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
	*    server_page.php
	*    
	*	 Jesse Berube 
	*    Marc Harquail
	*
	*/
	$servername = "107.180.27.180";
	$username = "MapleLeafAdmin";
	$password = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
	$content = file_get_contents("php://input");
	$data = json_decode($content);

	
	$uid = $data->uid;
	$temp = $data->temperature;
	$move = $data->movement;
	

	


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	if($move == "True"){
		$move = 1;
	}
	else{
		$move = 0;
	}

	$sql = "SELECT * FROM SENSORS WHERE uid = '".$uid."'";

	$result = $conn->query($sql);


	if ($result->num_rows > 0) {
		$sql = $conn->prepare("INSERT INTO SENSOR_".$uid." (temp, movement) VALUES (?,?)");
		$sql->bind_Param("di", $temp, $move);
					
		if ($sql->execute() === TRUE) {
		    echo "New record created successfully";
			checkTemp($temp, $uid, $conn);
		} 
		else {
		    error_log("Error: " . $sql . "<br>" . $conn->error,0);
		}
	}
	else{
		$insertSensor = $conn->prepare("INSERT INTO SENSORS (uid) VALUES (?)");
		$insertSensor->bind_Param("s", $uid);
		
		if($insertSensor->execute() === TRUE){
			$createTable = "CREATE TABLE `Mapleleaf_Capstone`.`SENSOR_".$uid."` ( `id` INT NOT NULL AUTO_INCREMENT , `temp` FLOAT(10,7) NOT NULL , `movement` BOOLEAN NOT NULL , `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = MyISAM;";
			$createResult = $conn->query($createTable);
			if($createResult){
				
				$sql = $conn->prepare("INSERT INTO SENSOR_".$uid." (temp, movement) VALUES (?,?)");
				$sql->bind_Param("di", $temp, $move);
				if ($sql->execute() === TRUE) {
				    echo "New record created successfully";
				} 
				else {
				    error_log("Error: " . $sql . "<br>" . $conn->error,0);
				}
			}
		}
	}
	
	
	function checkTemp($cTemp, $uid, $conn){
		$sqlThresh = "SELECT threshold FROM SENSORS WHERE uid = '".$uid."'";
		$thresh = $conn->query($sqlThresh);

		while($threshRow = $thresh->fetch_assoc()){
			if($threshRow['threshold'] > $ctemp){

				//Start of code for email notification 		 
				$sqlEmail = "SELECT lastEmail, emailDelay FROM EMAIL_NOTIF WHERE uid = '".$uid."'";
				$emailResult = $conn->query($sqlEmail);

				if($emailResult->num_rows == 0){				
					$sql = $conn->prepare("INSERT INTO EMAIL_NOTIF (uid) VALUES (?)");
				    $sql->bind_Param("s", $uid);
					$sql->execute();

					$sqlEmail = "SELECT lastEmail, emailDelay FROM EMAIL_NOTIF WHERE uid = '".$uid."'";
					$emailResult = $conn->query($sqlEmail);
				}

				while($innerResult = $emailResult->fetch_assoc()){
					$lastEmail = $innerResult['lastEmail'];
					$delay = $innerResult['emailDelay'];

					//Turn time received from database to unix timestamp
					$lastEmailUnix = strtotime($lastEmail);
					$currentTime = time();

					//Calulated the time difference in minutes
					$difference = ($currentTime - $lastEmailUnix)/60;			

					if($difference > $delay)
					{
						//Send the notifiation and updated the lastemail column in the database

						$sql = "SELECT EMAIL_LIST.email FROM EMAIL_LIST INNER JOIN SUB_STATUS ON EMAIL_LIST.id = SUB_STATUS.userId WHERE SUB_STATUS.uid = '".$uid."'";
						$emailArray = array();
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($emailRow = $result->fetch_assoc()){
								array_push($emailArray, '<'.$emailRow['email'].'>');
							}

							$sql = "SELECT cabinetName FROM LOCATION_SENSORS WHERE uid = '".$uid."'";	
							$cabResult = $conn->query($sql);	
							if($cabResult->num_rows >0){
								while($cabName = $cabResult->fetch_assoc()){
									$cabUid = $cabName['cabinetName'];
									notification($cabUid, $cTemp, $emailArray);
								}	
							}
							else
							{
								notification($uid, $cTemp, $emailArray);
							}

							$currentTime = date("Y-m-d H:i:s");
												
							$insert = $conn->prepare("UPDATE EMAIL_NOTIF SET lastEmail = ? WHERE uid = ?");
							$insert->bind_Param("is", $currentTime, $uid);
							$insert->execute();
						}
					}
				}
			}	
		}
	}
	
	function notification($id, $tempera, $eArray) {
		$subject = $id . " Is Over The Temperature Threshold";

		$message = $id . " is reading a temperature of " .$tempera. " degrees celsius, which exceeds the threshold set for this sensor.";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: <noreply@arraysatone.com>' . "\r\n";
		$headers .= 'Reply-To: <noreply@arraysatone.com>' . "\r\n";
		$headers .= 'To: '. implode(',', $eArray) . "\r\n";
		$headers .= 'Content-Type: text/html; charset=ISO-8859-1'. "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();
		mail($to,$subject,$message,$headers);

	}

	$conn->close();
?>