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

        * * * * * * * * * * * * * * * * * * * * * * * *

        cabinet.php

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
		<script src="./js/cabinetScript.js"></script>
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
        				<li class="nav-item">
        					<a class="nav-link" href="/">Home</a>
        				</li>
        				<li class="nav-item active">
        					<a class="nav-link" href="#">Live View</a>
        				</li>
        				<li class="nav-item">
        					<a class="nav-link" href="trends?uid=<?php include 'php/set_GET_uid.php' ?>"><?php include 'php/getCabinetName.php'?> Trends</a>
        				</li>
        				<?php  include './php/checkforuser.php' ?>
        			</ul>
        		</div>
            </div>
    	</nav>

    	<!-- Data Display -->
    	<div class="row">
    		<div class = "col cabinetName"><?php include 'php/getCabinetName.php'?></div>
    	</div>
    	<!-- Primary Temperature -->
		<div class="row">
			<div class="col block hist" style="text-align: center;" id="temp">
				<p class="temp" style="color:white">LOADING</p>
			</div>
		</div>

		<!-- Accelerometer Movement -->
		<div class="row">
			<div class="col block" id="accel">
				<p class="accel">No Movement Detected</p>
			</div>
		</div>

		<!-- MAX Temperature -->
		<div class="row" id="maxTemp">
			<div class="histLbl col hist">HIGH*</div>
			<div class="col hist histInfo">-- &degC</div>
		</div>

		<!-- MIN Temperature -->
		<div class="row" id="minTemp">
			<div class="col hist histLbl">LOW*</div>
			<div class="col hist histInfo">-- &degC</div>
		</div>

		<!-- Last Update -->
		<div class="row">
			<div class="col hist histLbl">Updated</div>
			<div class="col hist histInfo" id="time">--:--</div>
		</div>

		<!-- Disclaimer -->
		<div class="row">
			<div class="col disclaim histInfo">*LAST 24 HOURS</div>
		</div>
    	<div class="row optBtns">
			<div class="col subBtn">
				<button class="fas fa-star colorUnsubbed" onclick = "subUser()" id="subscribe"></button>
			</div>
			<div class="col setBtn float-right">
				<button class="fas fa-chart-area colorUnsubbed" onclick = "trendsClicked('<?php include 'php/set_GET_uid.php' ?>')" id="trendsBtn"></button>
			</div>
			<div class="col setBtn float-right">
				<button class="fas fa-cog colorUnsubbed" onclick = "settingsClicked('<?php include 'php/set_GET_uid.php' ?>')" id="settings"></button>
			</div>
		</div>
		<div class="row">
			<table class = "col eventTable">
				<tr class = "eventRow">
					<th></th>
					<th class = "eventHeader">Week</th>
					<th class = "eventHeader">Month</th> 
					<th class = "eventHeader">Year</th>
				</tr>
				<tr class = "eventRow">
					<td class = "eventHeader">Temperature</td>
					<td class = "eventData tempData">-</td>
					<td class = "eventData tempData">-</td> 
					<td class = "eventData tempData">-</td>
				</tr>
				<tr class = "eventRow">
					<td class = "eventHeader">Acceleration</td>
					<td class = "eventData accelData">-</td>
					<td class = "eventData accelData">-</td> 
					<td class = "eventData accelData">-</td>
				</tr>
			</table>
		</div>
	</body>
</html>