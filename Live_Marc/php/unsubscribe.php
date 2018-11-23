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

  $sql = "DELETE FROM `SUB_STATUS` WHERE `userId` = 1 AND `uid` = '$uid' ";
  $result = $conn->query($sql);

  if ($result) {
    echo "unsubbed";
  }
  else {
    echo mysqli_error($conn);
  }
  $conn->close();
?>