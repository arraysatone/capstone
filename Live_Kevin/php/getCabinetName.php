<?php
session_start();
  $servername = "107.180.27.180";
  $username = "MapleLeafAdmin";
  $password = "ClVq0Qzt21jz";
  $dbname = "Mapleleaf_Capstone";
  $uid = $_SESSION['uid'];


  $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

  $sql = "SELECT cabinetName FROM LOCATION_SENSORS WHERE uid = '$uid'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
        // output data of each row
    while($row = $result->fetch_assoc()) {
      $name = $row['cabinetName'];
    }
    echo $name;
  }
  else {
    echo "0 results";
  }
  $conn->close();
?>