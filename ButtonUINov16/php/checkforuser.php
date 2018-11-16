<?php

$dbservername = "142.55.32.48";
$dbusername = "irelaale_admin";
$dbpassword = "L}zOAdgkc[Wr";
$dbname = "irelaale_capstone";
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
		            echo '<div id="loginUID"><a class="nav-link" href="adjusttemp.php">'.$user.'</a></div>';
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
		            echo '<div id="loginUID"><a class="nav-link" href="adjusttemp.php">'.$user.'</a></div>';
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