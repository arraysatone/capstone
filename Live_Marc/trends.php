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

		<!-- Style Imports -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="./css/style_xs.css">
		<link rel="stylesheet" type="text/css" href="./css/style_sm.css">
	    <link rel="stylesheet" type="text/css" href="./css/style_md.css">
	    <link rel="stylesheet" type="text/css" href="./css/style_lg.css">

	    <!-- Script Imports -->
		<script src="./js/trendChart.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
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
        					<a class="nav-link" href="cabinet?uid=<?php echo ''.$_GET['uid'] ?>">Live View</a>
        				</li>
        				<li class="nav-item active">
        					<a class="nav-link" href="trends?uid=<?php echo ''.$_GET['uid'] ?>">Trends</a>
        				</li>
        				<li class="nav-item">
        					<a class="nav-link" onclick="shareEmail()">Share</a>
        				</li>
        			</ul>
        		</div>
            </div>
    	</nav>

    	<!-- Chart Displays-->
		<div class="col-lg-12">

			<div class="betweenPicker">
				<table>
					<tr>
						<td><h2 class="datePickerTitle">Start</h2></td>
						<td><h2 class="datePickerTitle">End</h2></td>
					</tr>
					<tr>
						<td><input id="recTempBefore" class="datePicker" type="date" name="bday"></td>
						<td><input id="redTempAfter" class="datePicker" type="date" name="bday"></td>
					</tr>
				</table>
			</div>

	    	<!-- Recent Temperatures -->
			<div class="row">
				<canvas class="col hist" id="recTemp"></canvas>
			</div>

			<!-- Recent Movement -->
			<div class="row">
				<canvas class="col hist" id="recMov"></canvas>
			</div>
		</div>
	</body>
</html>