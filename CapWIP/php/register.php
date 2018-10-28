<?php
	$dbservername = "142.55.32.48";
	$dbusername = "irelaale_admin";
	$dbpassword = "L}zOAdgkc[Wr";
	$dbname = "irelaale_capstone";

	$username = $_POST["user"];
	$split_user = str_split($username);
	$unhashed_pass = $_POST["pass"];
	$size_of_array = count($split_user);
	$unhashed_pass = $unhashed_pass.$split_user[0].$split_user[$size_of_array-1];
	$hashed_pass = password_hash($unhashed_pass,PASSWORD_DEFAULT);
	
	//Password is calculated by taking the first and last username characters and adding them onto the back of the password and then salting.
	
	if(password_verify('abc123','$2y$10$oD/YRblX53UyapSqRsnNuOjpGpEa/H7.B/WJ72KBa0HZ0rJiZsqFS')){
		echo "true<br>";
	} else{
		echo "false<br>";
	}
	
	
	echo $hashed_pass;
	
	// Create connection
	$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO UserTable (UserName, Password, Status)
	VALUES ('".$username."', '".$hashed_pass."', 'Regular')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    error_log("Error: " . $sql . "<br>" . $conn->error,0);
	}

	$conn->close();
?>