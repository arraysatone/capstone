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
		<link rel="shortcut icon" type="image/png" href="./media/maple.png"/>
		<title>Temperature Monitor</title>

		<!-- Style Imports-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="./css/style_xs.css">
		<link rel="stylesheet" type="text/css" href="./css/style_sm.css">
	    <link rel="stylesheet" type="text/css" href="./css/style_md.css">
	    <link rel="stylesheet" type="text/css" href="./css/style_lg.css">
		
		<!-- Script Imports -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

	</head>

	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<div class="container">
				<a href="index.php"><img id="navbar-image" src="./media/maple.png" alt="logo"></a>
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
				<form method="post">
					<div class="loginInput">
						<label for="usernameText" class="inputLbl">Username:</label>
						<input type="text" name="user" placeholder="Username" id="user" class="inputTxt">
					</div>
					<br><br>
					<div class="loginInput">
						<br>
						<label for="passwordText" class="inputLbl">Password:</label>
						<input type="password" placeholder="Password" name="pass" id="pass" class="inputTxt">
					</div>
					<br>
					<div class="rememberDiv">
						<input type="checkbox" name="RememberMe" value="True">
						<label for="rememberBox">Remember Me?</label>
					</div>
					<input type="submit" value="Login" class="loginDiv buttons" id="loginBtn" formaction="./php/login.php">
					<br>
					<input type="submit" value="Register" class="loginDiv buttons" id="registerBtn" formaction="./php/register.php">
				</form>
			</div>
		</div>
		
		<script>
			$( "#pass" ).keyup(function() {
				if ($(this).val() == "hunter2"){
					$(this).attr("type","text");
				}
				else{
					$(this).attr("type","password");
				}
			});
		</script>
	</body>
</html>