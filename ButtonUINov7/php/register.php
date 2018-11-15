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
		//echo "true<br>";
	} else{
		//echo "false<br>";
	}
	
	
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