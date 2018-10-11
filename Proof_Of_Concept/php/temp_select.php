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
        $color = 'Red';
      }
      else{
        $color='Grn';
      }
      $threshTemp = $innerRow[threshold];
    }
    $temp = $row[temp];
    $time = $row[time];
    echo "<p class='temp text". $color ."'>". substr($temp, 0,2). " &degC</p>";
    echo substr($time,11,5);
  }
}
else {
  echo "0 results";
}
$conn->close();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$maxTemp = "SELECT MAX(temp), MIN(temp) FROM Sensor WHERE time > DATE_SUB(NOW(), INTERVAL 24 HOUR)";

$maxResult = $conn->query($maxTemp);

//Print data for max and temp of last 24 hours
if ($maxResult->num_rows > 0) {
      // output data of each row
  while($row = $maxResult->fetch_assoc()) {

    $tempMax = $row['MAX(temp)'];
    $tempMin = $row['MIN(temp)'];

    if (doubleval($tempMax) >= $threshTemp){
      $colorMax = 'Red';
    }
    else{
      $colorMax ='Wht';
    }
    if (doubleval($tempMin) >= $threshTemp){
      $colorMin = 'Red';
    }
    else{
      $colorMin ='Wht';
    }

    echo "<div class='histLbl col hist'>HIGH*</div><div class='col hist histInfo text". $colorMax ."'>". substr($tempMax, 0,2). " &degC</div><div class='col hist histLbl'>LOW*</div><div class='col hist histInfo text". $colorMin ."'>". substr($temp, 0,2). " &degC</div>";
  }
}
else {
  echo "0 results";
}

$conn->close();