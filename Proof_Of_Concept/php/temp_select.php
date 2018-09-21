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

$sql = "SELECT temp,time FROM Sensor WHERE time=(SELECT MAX(time) FROM Sensor)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
      // output data of each row
  while($row = $result->fetch_assoc()) {
    $DOUBLEtemp = doubleval($row['temp']);
    if ($DOUBLEtemp>=28){
      $color = 'Red';
    }
    else{
      $color='Grn';
    }
    $temp = $row["temp"];
    $time = $row["time"];
    echo "<p class='temp text". $color ."'>". substr($temp, 0,2). " &degC</p>";
    echo substr($time,11,5);
  }
} else {
  echo "0 results";
}
$conn->close();
?>