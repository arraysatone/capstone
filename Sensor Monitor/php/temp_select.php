<?php
session_start();
/*
*    ArraysAtOne Capstone 2018 - Maple Leaf Foods
*
*    Kevin Baumgartner
*    Jesse Berube
*    Marc Harquail
*    Alex Ireland
*
* * * * * * * * * * * * * * * * * * * * * * * * *
*
*    temp_select.php
*    
*	 Marc Harquail
*
*/
$uid = $_SESSION['uid'];

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

$sql = "SELECT `temp`, `time` FROM SENSOR_$uid WHERE `time`=(SELECT MAX(`time`) FROM SENSOR_$uid)";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
      // output data of each row
  while($row = $result->fetch_assoc()) {
    $sqlThresh = "SELECT threshold FROM SENSORS WHERE uid = '".$uid."'";
    $thresh = $conn->query($sqlThresh);
    $DOUBLEtemp = doubleval($row['temp']);
    while($innerRow = $thresh->fetch_assoc()){
      if ($DOUBLEtemp >= $innerRow['threshold']){
		  
    		$color = 'Red';
      }
      else{
        $color='Grn';
      }
      $threshTemp = $innerRow['threshold'];
    }
    $temp = $row['temp'];
    $time = $row['time'];
    echo "<p class='temp text". $color ."'>". substr($temp, 0,2). "&degC</p>";
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

$maxTemp = "SELECT MAX(`temp`) as maxTemp, MIN(`temp`) as minTemp FROM SENSOR_$uid WHERE `time` > DATE_SUB(NOW(), INTERVAL 24 HOUR)";

$maxResult = $conn->query($maxTemp);

//Print data for max and temp of last 24 hours
if ($maxResult->num_rows > 0) {
      // output data of each row
  while($row = $maxResult->fetch_assoc()) {

    if(is_null($row['maxTemp'])){
      echo "<div class='histLbl col hist'>HIGH*</div><div class='col hist histInfo textNrm'>-- &degC</div><div class='col hist histLbl'>LOW*</div><div class='col hist histInfo textNrm'>-- &degC</div>";
    }
    else{
      $tempMax = $row['maxTemp'];
      $tempMin = $row['minTemp'];

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

      echo "<div class='histLbl col hist'>HIGH*</div><div class='col hist histInfo text". $colorMax ."'>". substr($tempMax, 0,2). " &degC</div><div class='col hist histLbl'>LOW*</div><div class='col hist histInfo text". $colorMin ."'>". substr($tempMin, 0,2). " &degC</div>";
    }
  }
}
else {
  echo "0 results";
}

$conn->close();

?>