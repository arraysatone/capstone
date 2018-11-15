<?php 
    session_start();
    $servername = "142.55.32.48";
    $username = "harquaim_php";
    $password = "c@pstone_server";
    $dbname = "harquaim_capstone";
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "SELECT threshold FROM TemperatureThresholds WHERE uid='0001203B'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $threshold = $row['threshold'];
      }
    }
    else {
      echo "0 results";
    }
    $conn->close();
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

    <!-- Body -->
    <body>

        <!-- Navigation Bar -->
    	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">

                <!-- Logo -->
        		<a href="index.php"><img id="navbar-image" src="./media/maple.png" alt="logo"></a>

                <!-- Dropdown Menu -->
        		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        			<span class="navbar-toggler-icon"></span>
        		</button>

                <!-- Dropdown Items -->
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
        				<li class="nav-item">
        				    <?php
                                include './php/checkforuser.php';
                            ?>
        				</li>
        			</ul>
        		</div>
            </div>
    	</nav>
        <div class="row">
            <div class="col-lg-12">
                <!-- Cabinet List -->
                <div class="loginDiv">
                	<input type="range" id="rangeThresh" min='10' max='70' class="slider" value=<?php echo "'".$threshold."'"; ?> oninput="updateTextInput(this.value);">
                	<input type="number" id="textThresh" min='10' max='70' class="tempNum" value=<?php echo "'".$threshold."'"; ?> onchange="updateRangeInput(this.value);"/>
                </div>
                <br>
            	<input type="button" id="submitToAjax" class="loginDiv buttons" value="Change Threshold">
                <div id="successDiv">Threshold Changed</div>
            </div>
        </div>
    </body>
    
    <script>
    
    function updateTextInput(val) {
          document.getElementById('textThresh').value=val; 
    }
    function updateRangeInput(val) {
        if (val >70){
            val = 70;
        }
        else if(val < 10){
            val = 10;
        }
        document.getElementById('rangeThresh').value=val;
        document.getElementById('textThresh').value=val;
    }
    
    
    $("#submitToAjax").click(function(){
        $.post("./php/tempchanger.php", { temp: ""+document.getElementById("textThresh").value },
        function(data, status){
            var threshText = document.getElementById("successDiv");
            threshText.style.display = "inline";
            setTimeout(function(){
                threshText.style.display = "none";
            }, 3000);
            //alert("Status: " + status);
        });
    }); 
    </script>
</html>
