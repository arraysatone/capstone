<?php
session_start();
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require '/home/berubeje/public_html/Notification/PHPMailer/src/Exception.php';
// require '/home/berubeje/public_html/Notification/PHPMailer/src/PHPMailer.php';
// require '/home/berubeje/public_html/Notification/PHPMailer/src/SMTP.php';
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

$sql = "SELECT temp, time FROM SENSOR_$uid WHERE time=(SELECT MAX(time) FROM SENSOR_$uid)";

$result = $conn->query($sql);

//Print data for current temp WRITTEN BY JESSE
if ($result->num_rows > 0) {
      // output data of each row
  while($row = $result->fetch_assoc()) {
    $sqlThresh = "SELECT threshold FROM SENSORS WHERE uid = '".$uid."'";
    $thresh = $conn->query($sqlThresh);
    $DOUBLEtemp = doubleval($row['temp']);
    while($innerRow = $thresh->fetch_assoc()){
      if ($DOUBLEtemp >= $innerRow[threshold]){
		  
    		$color = 'Red';
    		 
    		//Start of code for email notification 		 
    		$sqlEmail = "SELECT lastEmail, emailDelay FROM EMAIL_NOTIF WHERE uid = '".$uid."'";
    		$emailResult = $conn->query($sqlEmail);
    		
    		
    		 while($innerResult = $emailResult->fetch_assoc()){
    		 	$lastEmail = $innerResult[lastEmail];
    		 	$delay = $innerResult[emailDelay];
				
    		 	//Turn time received from database to unix timestamp
    			$lastEmailUnix = strtotime($lastEmail);
    		 	$currentTime = time();
    			
    		 	//Calulated the time difference in minutes
    		 	$difference = ($currentTime - $lastEmailUnix)/60;			

    		 	if($difference > $delay)
    		 	{
    		 		//Send the notifiation and updated the lastemail column in the database
    		 	  notification($uid, $DOUBLEtemp);
    		 		$currentTime = date("Y-m-d H:i:s");
    		 		$insert = "UPDATE EMAIL_NOTIF SET lastEmail = '".$currentTime."' WHERE uid = '".$uid."'";
    		 		$runInsert = $conn->query($insert);		
    		 	}

    		 }
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

$maxTemp = "SELECT MAX(temp), MIN(temp) FROM SENSOR_$uid WHERE time > DATE_SUB(NOW(), INTERVAL 24 HOUR)";

$maxResult = $conn->query($maxTemp);

//Print data for max and temp of last 24 hours
if ($maxResult->num_rows > 0) {
      // output data of each row
  while($row = $maxResult->fetch_assoc()) {

    if(is_null($row['MAX(temp)'])){
      echo "<div class='histLbl col hist'>HIGH*</div><div class='col hist histInfo textNrm'>-- &degC</div><div class='col hist histLbl'>LOW*</div><div class='col hist histInfo textNrm'>-- &degC</div>";
    }
    else{
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

      echo "<div class='histLbl col hist'>HIGH*</div><div class='col hist histInfo text". $colorMax ."'>". substr($tempMax, 0,2). " &degC</div><div class='col hist histLbl'>LOW*</div><div class='col hist histInfo text". $colorMin ."'>". substr($tempMin, 0,2). " &degC</div>";
    }
  }
}
else {
  echo "0 results";
}

 function notification($id, $tempera) {
	emailNotificiation($id, $tempera);
    webNotification($id, $tempera);
 }
 
 function webNotification($id, $tempera)
 {
	 echo "
		<script type='text/javascript'>
                alert('JavaScript is awesome!');
        </script>";
	 "
 }
 
 
 function emailNotificiation($id, $tempera)
 {
	$subject = "Sensor " . $id . " Is Over Temperature Threshold";

   $message = "Sensor ". $id . " is reading a temperature of " .substr($tempera, 0,2). " degrees celsius, which exceeds the threshold set for this sensor.";

  
   $headers = 'MIME-Version: 1.0' . "\r\n";
   $headers = 'From: <noreply@arraysatone>' . "\r\n";
   $headers .= 'Reply-To: <noreply@arraysatone>' . "\r\n";
   $headers .= 'To: <digitalmenace1@gmail.com>, <jesse@leadwave.ca>'. "\r\n";
   $headers .= 'Content-Type: text/html; charset=ISO-8859-1'. "\r\n";
   $headers .= 'X-Mailer: PHP/' . phpversion();
   mail($to,$subject,$message,$headers);
 }




$conn->close();

?>