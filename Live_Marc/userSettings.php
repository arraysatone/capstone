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
		<script src="./js/emailList.js"></script>

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
			.selected {
				background-color: blue;
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
        				<li class="nav-item">
        				    <?php  include './php/checkforuser.php' ?>
        				</li>
        			</ul>
        		</div>
            </div>
    	</nav>

    	<table id="table" >
    		<thead>
    			<tr id ="tableHeaders">
    				<th>First Name</th>
    				<th>Last Name</th>
    				<th>Username	</th>
    				<th>Email</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php 

    			$sql = "SELECT id, firstName, lastName,username, email FROM EMAIL_LIST";
    			$result = $conn->query($sql);
    			if ($result->num_rows > 0) {
    				while($row = $result->fetch_assoc()) {
    					echo "<tr><td style='display:none';>".$row['id']."</td><td>". $row['firstName']."</td><td>".$row['lastName']."</td><td>"
    					.$row['username']."</td><td>".$row['email']."</td></tr>"; 
    				}
    			}
    			else{
    				echo "0 results";
    			}
    			$conn->close();


    			?>
    		</tbody>
    	</table>
    	<br>
    	<form>
    		*Required<br>
    		First Name*: <input type="text" name="fname" placeholder="First Name" required><br>
    		Last Name*: <input type="text" name="lname" placeholder="Last Name" required><br>
    		Username*: <input type="text" name="uname" placeholder="Username" required><br>
    		Email Address*: <input type="email" name="emailAdd"  placeholder="Email Address" required><br>

    		<input type="button" id="add" class="loginDiv buttons" value="Add">
    		<input type="button" id="update" class="loginDiv buttons" value="Update">
    		<input type="button" id="remove" class="loginDiv buttons" value="Remove">
    	</form>
    </div>
    <div id = "feedback">Database Successfully Updated</div>
	</body>
</html>