<?php


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
	$dbservername = "142.55.32.48";
	$dbusername = "irelaale_admin";
	$dbpassword = "L}zOAdgkc[Wr";
	$dbname = "irelaale_capstone";
	
	
	$username = $_POST["user"];
	$unhashed_pass = $_POST["pass"];
	$rememberMe = $_POST["RememberMe"];
//	echo "".$rememberMe;
	$split_user = str_split($username);
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
	            //echo "Cookie Remember Me success"; 
	        }
		    
		}else{
		    $rememberSql = "INSERT INTO RememberMe (ForeignID,Cookie,Type) VALUES ('".$userID."','".session_id()."','Session')";
		    if ($conn->query($rememberSql) === TRUE) {
	            //echo "Session Remember Me success";
	        }
		}

	} else{
		//echo "Login failure";
	}
	
	$conn->close();
	

?>

<script>
	window.onload = function(){
		window.location.replace("http://harquaim.dev.fast.sheridanc.on.ca/CapWIP/");
	};
</script>
<?php 
    session_start();
?>

<!-- 

        ArraysAtOne Capstone 2018 - Maple Leaf Foods

        Kevin Baumgartner
        Jesse Berube
        Marc Harquail
        Alex Ireland

 -->
<!DOCTYPE html>

<!-- HTML -->
<html>

    <!-- Head -->
    <head>

        <!-- Meta -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/png" href="../media/maple.png"/>
		<title>Temperature Monitor</title>

		<!-- Style Imports-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style_xs.css">
		<link rel="stylesheet" type="text/css" href="../css/style_sm.css">
	    <link rel="stylesheet" type="text/css" href="../css/style_md.css">
	    <link rel="stylesheet" type="text/css" href="../css/style_lg.css">
		
		<!-- Script Imports -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

	</head>

	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<div class="container">
				<a href="index.php"><img id="navbar-image" src="../media/maple.png" alt="logo"></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        			<span class="navbar-toggler-icon"></span>
        		</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item active">
							<a class="nav-link" href="#">Cabinet<span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="cabinet.html">Live View</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="trends.html">Trends</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="row">
			<div class="col-lg-12">
			</div>
		</div>
	</body>
</html>