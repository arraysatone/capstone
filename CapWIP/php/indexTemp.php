<?php
$servername = "107.180.27.180";
$username = "MapleLeafAdmin";
$password = "ClVq0Qzt21jz";
$dbname = "Mapleleaf_Capstone";

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT temp, time FROM SENSOR_0001203B WHERE time=(SELECT MAX(time) FROM SENSOR_0001203B)";

$result = $conn->query($sql);

//Print data for current temp
if ($result->num_rows > 0) {
      // output data of each row
  while($row = $result->fetch_assoc()) {
    $uid = "0001203B";
    $sqlThresh = "SELECT threshold FROM SENSORS WHERE uid = '".$uid."'";
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