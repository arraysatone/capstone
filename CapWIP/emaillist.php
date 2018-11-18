<!DOCTYPE html>

<html>
<head>
</head>

<body>
<table>
	<tr>
		<th>First Name<th>
		<th>Last Name<th>
		<th>Email<th>
	</tr>
	<?php 
    session_start();
    $servername = "107.180.27.180";
    $username = "MapleLeafAdmin";
    $password = "ClVq0Qzt21jz";
    $dbname = "Mapleleaf_Capstone";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "SELECT firstName, lastName, email FROM EMAIL_LIST";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $row['firstName']."</td><td>".$row['lastName']."</td><td>".$row['email']."</td></tr>"; 
      }
    }
    else {
      echo "0 results";
    }
    $conn->close();
?>
	
	
</table>
</body>
</html>