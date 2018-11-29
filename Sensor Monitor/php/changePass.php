<?php
	if(!isset($_SESSION)) {
		session_start();
	}

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
	*    register.php
	*    
	*    Alex Ireland
	*localhost/php/changePass.php?pass=cunt&newpass=notacunt
	*/
	
	$dbservername = "107.180.27.180";
	$dbusername = "MapleLeafAdmin";
	$dbpassword = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
	$loggedin = false;
	
	// Create connection
	$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	
	
	
	if(isset($_COOKIE['LoginKey'])) {
		$sql = "SELECT * FROM RememberMe WHERE Cookie='".$_COOKIE['LoginKey']."' LIMIT 1"; //Finds user by cookie
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
						$username = $row['Username'];
						$loggedin = true;
					}
				}
				
			}
		}
		
		
	}else{
		$sql = "SELECT * FROM RememberMe WHERE Cookie='".session_id()."' LIMIT 1"; //Finds user by session
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
						$username = $row['Username'];
						$loggedin = true;
					}
				}
				
			}
		}
		
	}

	if($loggedin){ // Has the username been found? Is he logged in?
		//This is all the stuff for password changing, assuming that the username has been set from the code above
		$split_user = str_split($username);
		$unhashed_pass = $_POST["pass"];
		$new_unhashed_pass= $_POST['newpass'];
		$size_of_array = count($split_user);
		$unhashed_pass = $unhashed_pass.$split_user[0].$split_user[$size_of_array-1];
		$new_unhashed_pass = $new_unhashed_pass.$split_user[0].$split_user[$size_of_array-1];
		$hashed_pass = password_hash($unhashed_pass,PASSWORD_DEFAULT);
		$new_hashed_pass = password_hash($new_unhashed_pass,PASSWORD_DEFAULT);
		
		//Password is calculated by taking the first and last username characters and adding them onto the back of the password and then salting.
		
		$sql = "SELECT Password FROM UserTable WHERE Username='".$username."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$assessment_hash = $row["Password"];
				if (password_verify($unhashed_pass,$assessment_hash)){
					//Correct password
					$sql = "UPDATE UserTable SET Password='".$new_hashed_pass."' WHERE Username='".$username."'";
					if ($conn->query($sql) === TRUE) {
						echo 'success';
					}
					else{
						echo "Error: " . $sql . "<br>" . $conn->error,0;
						error_log("Error: " . $sql . "<br>" . $conn->error,0);
					}
				}
				else{
					echo "Password Incorrect";
				}
				

			}
		}
		else{
			//No user found 
			echo "No user found";
		}
		
	}
	else{
		header("Location: /");
	}
	$conn->close();
?>
