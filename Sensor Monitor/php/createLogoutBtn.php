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
*    createLogoutBtn.php
*    
*    Alex Ireland
*
*/
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
	$sql = "SELECT * FROM RememberMe WHERE Cookie='".$_COOKIE['LoginKey']."' LIMIT 1";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	// output data of each row
		while($row = $result->fetch_assoc()) {
			$UID = $row['ForeignID'];
			$sql = "SELECT * FROM UserTable WHERE ID='".$UID."' LIMIT 1";
            $result = $conn->query($sql);
			if ($result->num_rows > 0) {    
		    // output data of each row
		        while($row = $result->fetch_assoc()) {
		            $loggedin = true;
		        }
			}
			
		}
	}
	
	
}else{
	$sql = "SELECT * FROM RememberMe WHERE Cookie='".session_id()."' LIMIT 1";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	// output data of each row
		while($row = $result->fetch_assoc()) {
			$UID = $row['ForeignID'];
			$sql = "SELECT * FROM UserTable WHERE ID='".$UID."' LIMIT 1";
            		$result = $conn->query($sql);
			if ($result->num_rows > 0) {    
		    // output data of each row
		        while($row = $result->fetch_assoc()) {
		            $loggedin = true;
		        }
			}
			
		}
	}
	
}

if($loggedin){
    echo '<li class="nav-item"><div id="loginUID"><a class="nav-link" href="php/logout.php">Logout</a></div></li>';
}
?>