<?php

//generateRandomString creates a random string of 100 characters for the creation of the cookie (Name of cookie is: LoginKey) 
    function generateRandomString($length = 100) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    
	session_start();
	$dbservername = "107.180.27.180";
	$dbusername = "MapleLeafAdmin";
	$dbpassword = "ClVq0Qzt21jz";
	$dbname = "Mapleleaf_Capstone";
	
	
	$username = $_POST["user"]; //The username used in the login page
	$unhashed_pass = $_POST["pass"]; //Password in login page
	$rememberMe = $_POST["rememberMe"]; //This is the remember me box that is on the login page, if checked, returns "True"
	$split_user = str_split($username); //Splits username string into each individual character
	$size_of_array = count($split_user);
	$unhashed_pass = $unhashed_pass.$split_user[0].$split_user[$size_of_array-1]; //Applying the first and last digits of user

	// Create connection
	$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT ID,Password FROM UserTable WHERE Username='".$username."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$userID = $row["ID"];
			$assessment_hash = $row["Password"];
		}
	} else {
		//echo "0 results";
	}
	
	if (password_verify($unhashed_pass,$assessment_hash)){
		//echo "Login successful";
		//echo "OK!";
		if ($rememberMe == "True"){
		    
		    $generatedKey = generateRandomString();
		    $oneDayInSeconds = 60*60*60*24;
		    setcookie("LoginKey",$generatedKey,time()+$oneDayInSeconds, "/");
		    
		    
		    $rememberSql = "INSERT INTO RememberMe (ForeignID,Cookie,Type) VALUES ('".$userID."','".$generatedKey."','Cookie')";
		    if ($conn->query($rememberSql) === TRUE) {
	            	echo "success"; 
	        }
		    
		}else{
		    $rememberSql = "INSERT INTO RememberMe (ForeignID,Cookie,Type) VALUES ('".$userID."','".session_id()."','Session')";
		    if ($conn->query($rememberSql) === TRUE) {
	            	echo "success";
	        }
		}

	} else{
		echo "Password incorrect";
	}
	
	$conn->close();
	

?>