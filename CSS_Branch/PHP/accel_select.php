<?php
$servername = "142.55.32.48";
$username = "harquaim_php";
$password = "c@pstone_server";
$dbname = "harquaim_capstone";



$conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT uid, time FROM sensor2 WHERE time = (SELECT MAX(time) from sensor2)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
      // output data of each row
  while($row = $result->fetch_assoc()) {
    $uid = $row[uid];
    $time = strtotime($row[time]);
    $curtime = time();
    $relTime = $curtime - $time;
    if (($curtime - $time) >= 10){
      $color='Gry';
      echo "<p class='accel text". $color ."'>No Movement Detected</p>";
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