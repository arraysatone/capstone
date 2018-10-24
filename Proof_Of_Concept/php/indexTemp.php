<?php
$servername = "142.55.32.48";
$username = "harquaim_php";
$password = "c@pstone_server";
$dbname = "harquaim_capstone";

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT temp, time, uid FROM Sensor WHERE time=(SELECT MAX(time) FROM Sensor)";

$result = $conn->query($sql);

//Print data for current temp
if ($result->num_rows > 0) {
      // output data of each row
  while($row = $result->fetch_assoc()) {
    $uid = $row[uid];
    $sqlThresh = "SELECT threshold FROM TemperatureThresholds WHERE uid = '".$uid."'";
    $thresh = $conn->query($sqlThresh);
    $DOUBLEtemp = doubleval($row['temp']);
    while($innerRow = $thresh->fetch_assoc()){
      if ($DOUBLEtemp >= $innerRow[threshold]){
        echo "btn-sq-rd";
      }
      else{
        echo "btn-sq-nm";
      }
      echo "".substr($DOUBLEtemp,0,2)."&degC";
    }
  }
}
else {
  echo "0 results";
}
$conn->close();
?>