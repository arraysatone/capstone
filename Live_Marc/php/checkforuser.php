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
		            $user = $row['Username'];
		            echo '<li class="nav-item">
			            		<div id="loginUID">
			            			<a class="nav-link" href="userSettings">'.$user.'\'s settings</a>
			            		</div>
			            	</li>
			            	<li class="nav-item">
			            		<div id="logoutUID">
			            			<a class="nav-link" href="./php/logout">Logout</a>
			            		</div>
		            		</li>';
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
		            $user = $row['Username'];
		            echo '<li class="nav-item">
			            		<div id="loginUID">
			            			<a class="nav-link" href="userSettings">'.$user.'\'s settings</a>
			            		</div>
			            	</li>
			            	<li class="nav-item">
			            		<div id="logoutUID">
			            			<a class="nav-link" href="./php/logout">Logout</a>
			            		</div>
		            		</li>';
		            $loggedin = true;
		        }
			}
			
		}
	}
	
}

if(!$loggedin){
    echo '<div id="loginUID"><a class="nav-link" href="login.php">Login</a></div>';
}
?>