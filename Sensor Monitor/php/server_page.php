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

	$sql = "SELECT * FROM SENSORS WHERE uid = '.$uid.'";

	$result = $conn->query($sql);

	//Print data for current temp WRITTEN BY JESSE
	if ($result->num_rows > 0) {
		$sql = "INSERT INTO SENSOR_".$uid." (temp, movement) VALUES (".$temp.", ".$move.")";
		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} 
		else {
		    error_log("Error: " . $sql . "<br>" . $conn->error,0);
		}
	}
	else{
		$insertSensor = "INSERT INTO SENSORS (uid) VALUES ('.$uid.')";
		$insertResult = $conn->query($insertSensor);
		if($insertResult){
			$createTable = "CREATE TABLE `Mapleleaf_Capstone`.`SENSOR_".$uid."` ( `id` INT NOT NULL AUTO_INCREMENT , `temp` FLOAT(10,7) NOT NULL , `movement` BOOLEAN NOT NULL , `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = MyISAM;";
			$createResult = $conn->query($createTable);
			if($createResult){
				$sql = "INSERT INTO SENSOR_".$uid." (temp, movement) VALUES (".$temp.", ".$move.")";
				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully";
				} 
				else {
				    error_log("Error: " . $sql . "<br>" . $conn->error,0);
				}
			}
		}
	}

	$conn->close();
?>