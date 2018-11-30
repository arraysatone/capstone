<?php 
    session_start();

    if (isset($_GET['uid'])) {
		$_SESSION['uid'] = $_GET['uid'];
	}
	else{
		$_SESSION['uid'] = "0001203B";
	}
?>

<!-- 

        ArraysAtOne Capstone 2018 - Maple Leaf Foods

        Kevin Baumgartner
        Jesse Berube
        Marc Harquail
        Alex Ireland

        - - - - - - - - - - - - - - - - - - - - - - -

		login.php

        Jesse Berube
        Marc Harquail

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

		<!-- Style Imports -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="./css/style_xs.css">
		<link rel="stylesheet" type="text/css" href="./css/style_sm.css">
	    <link rel="stylesheet" type="text/css" href="./css/style_md.css">
	    <link rel="stylesheet" type="text/css" href="./css/style_lg.css">
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

		<!-- Script Imports -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
		<script src="./js/userList.js"></script>
		<style>
			table,tr,th,td
			{
				border: 2px solid white;
				color: white;
				user-select: none; 
				-moz-user-select: none; 
				-khtml-user-select: none;
				onselectstart="javascript:return false;
			}
			form{
				width: 96%;
				margin-top: 2%;
				margin-left: 2%;
				margin-right: 2%;
			}
			table
			{
				width: 96%;
				margin-top: 2%;
				margin-left: 2%;
				margin-right: 2%;
			}
			.saveButton {
				display:none;
			}
			#feedback
			{
				display:none;
			}

		</style>
	</head>

	<!-- Body -->
	<body>

		<!-- Navigation Bar -->
    	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">

                <!-- Logo -->
        		<a href="/"><img id="navbar-image" src="./media/maple.png" alt="logo"></a>

                <!-- Dropdown Menu -->
        		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        			<span class="navbar-toggler-icon"></span>
        		</button>

                <!-- Dropdown Items -->
        		<div class="collapse navbar-collapse" id="navbarNav">
        			<ul class="navbar-nav">
        				<li class="nav-item active">
        					<a class="nav-link" href="#">Live View</a>
        				</li>
        				<li class="nav-item">
        					<a class="nav-link" href="trends?uid=<?php include 'php/set_GET_uid.php' ?>">Trends</a>
        				</li>
        				<li class="nav-item">
        					<a class="nav-link" href="settings?uid=<?php include 'php/set_GET_uid.php' ?>">Settings</a>
        				</li>
        				<?php  include './php/checkforuser.php' ?>
        			</ul>
        		</div>
            </div>
    	</nav>
    	<div id="registrarForm">
    		<h1 class="registrarHeader">New User</h1>
			<div class="registrarLabel" id="firstnameText">First Name:</div>
			<input class="formcontrol" type="text" id="firstname">
			<div class="registrarLabel" id="lasenameText">Last Name:</div>
			<input class="formcontrol" type="text" id="lastname">
			<div class="registrarLabel" id="emailText">Email:</div>
			<input class="formcontrol" type="text" id="email">
			<div class="registrarLabel" id="usernameText">Username:</div>
			<input class="formcontrol" type="text" id="username">
			<div class="registrarLabel" id="passwordText">Password:</div>
			<input class="formcontrol" type="password" id="password">
			<br>
			<input class="registrarButton" type="button" value="Create User" onclick="CreateUser()">
		</div>
		
		<script>
		function CreateUser(){
			var postData = {
				"user": document.getElementById("username").value,
				"pass" : document.getElementById("password").value,
				"firstname" : document.getElementById("firstname").value,
				"lastname" : document.getElementById("lastname").value,
				"email" : document.getElementById("email").value
			};
			$.post("php/register.php",postData,function(data,status){
		        	console.log("Data: " + data + "\nStatus: " + status);
		        	if (data == "success"){
		        		console.log("Success");
		        	}
		        	else if(data == "Password incorrect"){
		        	}
					else if(data == "User already exists"){
					}
			});
		}
		function DoSomething(){
			console.log("I did something");
		}
		function GenerateSuccess(){
			console.log("Success Generated");
			$(".formcontrol").addClass("Success");
		}
		function GenerateError(){
			console.log("Error Generated");
			$(".formcontrol").addClass("Error");
		}
		
		function RemoveErrorSuccess(){
			$(".formcontrol").removeClass("Error");
			$(".formcontrol").removeClass("Success");
		}
		</script>
		
		
		

	</body>
</html>