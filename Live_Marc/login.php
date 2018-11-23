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
					</ul>
				</div>
			</div>
		</nav>
		<div class="row">
			<div class="col-lg-12">
				<form method="post" novalidate>
					<div class="loginInput form-group">
						<label for="usernameText" class="inputLbl col-sm-2 control-label">Username:</label>
						<div class="col-sm-10">
							<input type="text" name="user" placeholder="Username" id="usernameText" class="inputTxt form-control">
						</div>
					</div>
					
					<div class="loginInput form-group">
						<br>
						<label for="passwordText" class="inputLbl col-sm-2 col-form-label">Password:</label>
						<div class="col-sm-10">
							<input type="password" placeholder="Password" name="pass" id="passwordText" class="inputTxt form-control">
						</div>
					</div>
					<br>
					<div class="rememberDiv">
						<input type="checkbox" id="rememberMe" value="True">
						<label for="rememberBox">Remember Me?</label>
					</div>
					
					
					
					<input type="button" value="Login" class="loginDiv buttons" id="loginBtn" onclick="Login()">
					<br>
					<input type="button" value="Register" class="loginDiv buttons" id="registerBtn" onclick="Register()">
				</form>
			</div>
		</div>
		
		<script>
/*
Register to be used later in superuser acc

		function Register(){
		
			var postData = {
				"user": document.getElementById("user").value,
				"pass" : document.getElementById("pass").value
			};
			$.post("php/register.php",postData,function(data,status){
		        	console.log("Data: " + data + "\nStatus: " + status);
		        	$("#user").value = "";
		        	$("#pass").value = "";
			});
		}
*/
		function Login(){
			var postData = {
				"user": document.getElementById("user").value,
				"pass" : document.getElementById("pass").value,
				"rememberMe" : document.getElementById("rememberMe").value
			};
			$.post("php/login.php",postData,function(data,status){
		        	console.log("Data: " + data + "\nStatus: " + status);
		        	if (data == "success"){
		        		window.location.replace("/")
		        	}
		        	else if(data == "Password incorrect"){
		        		console.log("Error handling");
		        	}
		        		
			});
		}
		
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