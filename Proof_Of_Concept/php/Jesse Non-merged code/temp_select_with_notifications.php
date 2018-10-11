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

$sql = "SELECT temp,time, uid FROM Sensor WHERE time=(SELECT MAX(time) FROM Sensor)";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
      // output data of each row
  while($row = $result->fetch_assoc()) {
    $uid = $row[uid];
    $sqlThresh = "SELECT threshold FROM TemperatureThresholds WHERE uid = '".$uid."'";
    $thresh = $conn->query($sqlThresh);
    $DOUBLEtemp = doubleval($row['temp']);
    while($innerRow = $thresh->fetch_assoc()){
      if ($DOUBLEtemp >= $innerRow[threshold]){
        $color = 'Red';
		notification($uid, $DOUBLEtemp);
      }
      else{
        $color='Grn';
      }
    }
    $temp = $row["temp"];
    $time = $row["time"];
    echo "<p class='temp text". $color ."'>". substr($temp, 0,2). " &degC</p>";
    echo substr($time,11,5);
  }
}
else {
  echo "0 results";
}

function notification($id, $tempera) {
$to = "jesse@leadwave.ca";
$subject = "Sensor " . $id . " Is Over Temperature Threshold";


$message = "Sensor ". $id . " is reading a temperature of " .substr($tempera, 0,2). " degrees celsius, which exceeds the threshold set for this sensor.";

$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-Type: text/html; charset=ISO-8859-1'. "\r\n";

mail($to,$subject,$message);
}

$conn->close();
?>