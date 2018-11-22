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

  $sql = "SELECT time, movement FROM SENSOR_".$uid." WHERE time = (SELECT MAX(time) from SENSOR_".$uid.")";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
        // output data of each row
    while($row = $result->fetch_assoc()) {
      $move = $row[movement];
      $time = strtotime($row['time']);
      $curtime = time();
      if (($curtime - $time) >= 10 || $move == 0){
        $color='Gry';
        echo "<p class='accel'>No Movement Detected</p>";
      }
      else{
        $color = 'Red';
        echo "<p class='accel text". $color ."'>Movement Detected</p>";
      }
    }
  }
  else {
    echo "0 results";
  }
  $conn->close();
?>