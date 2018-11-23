<?php
	
	
	$dbservername = "107.180.27.180";
	$dbusername = "MapleLeafAdmin";
	$dbpassword = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";

	$username = $_POST["user"];
	$split_user = str_split($username);
	$unhashed_pass = $_POST["pass"];
	$size_of_array = count($split_user);
	$unhashed_pass = $unhashed_pass.$split_user[0].$split_user[$size_of_array-1];
	$hashed_pass = password_hash($unhashed_pass,PASSWORD_DEFAULT);
	
	//Password is calculated by taking the first and last username characters and adding them onto the back of the password and then salting.
	
	//echo $hashed_pass;
	
	// Create connection
	$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO UserTable (UserName, Password, Status)
	VALUES ('".$username."', '".$hashed_pass."', 'Regular')";

	if ($conn->query($sql) === TRUE) {
	    //echo "New record created successfully";
	} else {
	    //error_log("Error: " . $sql . "<br>" . $conn->error,0);
	}

	$conn->close();
?>
<html>
</html>
