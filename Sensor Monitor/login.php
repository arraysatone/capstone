<?php 
    session_start();
?>

<!-- 

        ArraysAtOne Capstone 2018 - Maple Leaf Foods

        Kevin Baumgartner
        Jesse Berube
        Marc Harquail
        Alex Ireland

        - - - - - - - - - - - - - - - - - - - - - - -

		login.php

        Kevin Baumgartner
        Alex Ireland

 -->
 
<!DOCTYPE html>

<!-- HTML -->
<html>

    <!-- Head -->
    <head>

        <!-- Meta -->
        <?php include 'php/loginBypass.php' ?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/png" href="./media/maple.png"/>
		<title>Temperature Monitor</title>

		<!-- Style Imports-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="./css/style_login.css">
	    <link rel="stylesheet" type="text/css" href="./css/SpecificCSSFiles/checkbox_styles.css">
		
		<!-- Script Imports -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

	</head>

	<body>
		<div class="row">
		<div id="loginHeader">
			<img id="loginHeaderImage" src="media/maple.png" alt="logo">
		</div>
			<div class="col-lg-12">
				<form method="post" novalidate>
					<div class="loginInput form-group">
						<label for="usernameText" class="inputLbl col-sm-2 control-label">Username:</label>
						<div class="col">
							<input type="text" name="user" placeholder="Username" id="usernameText" class="inputTxt form-control">
						</div>
					</div>
					
					<div class="loginInput form-group">
						<label for="passwordText" class="inputLbl col-sm-2 col-form-label">Password:</label>
						<div class="col">
							<input type="password" placeholder="Password" name="pass" id="passwordText" class="inputTxt form-control">
						</div>
					</div>
					<div class="loginInput">
						<div class="col">
							<label for="rememberBox">Remember Me?</label>
							<input type="checkbox" id="rememberMe" value="True">
						</div>
					</div>
					<input type="button" value="Login" class="loginButton" id="loginBtn" onclick="Login()">
				</form>
				<div class="errorArea">
					<p class="invalidHidden" id="invalidPass">Invalid password</p>
				</div>
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
			var checkboxResult = "";
			if ($('#rememberMe').is(':checked')) {
				checkboxResult = "True";
			}

			var postData = {
				"user": document.getElementById("usernameText").value,
				"pass" : document.getElementById("passwordText").value,
				"rememberMe" : checkboxResult
			};
			$.post("php/login.php",postData,function(data,status){
		        	console.log("Data: " + data + "\nStatus: " + status);
		        	if (data == "success"){
		        		window.location.replace("/")
		        	}
		        	else if(data == "Password incorrect"){
		        		$("#invalidPass").removeClass( "invalidHidden" ).addClass( "invalidShow" );
		        		$("#passwordText").val("");
		        		setTimeout(
						  function(){
						  	$("#invalidPass").removeClass( "invalidShow" ).addClass( "invalidHidden" );
						  }, 5000);
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
		
		var usernamefield = document.getElementById("usernameText");
		var passwordfield = document.getElementById("passwordText");
		usernamefield.addEventListener("keyup", function(event) {
			event.preventDefault();
			if (event.keyCode === 13) {
				passwordfield.focus()
			}
		});

		
		passwordfield.addEventListener("keyup", function(event) {
			event.preventDefault();
			if (event.keyCode === 13) {
				document.getElementById("loginBtn").click();
			}
		});
		
		</script>
	</body>
</html>