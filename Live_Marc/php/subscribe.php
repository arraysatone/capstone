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

  $sql = "SELECT * FROM SUB_STATUS WHERE uid = '$uid' AND userID = 1";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "remove";
  }
  else {
    $sql = "INSERT INTO `SUB_STATUS` (userId, uid) VALUES ('1','$uid')";
    $result = $conn->query($sql);
    if ($result) {
      echo "added";
    }
  }
  $conn->close();
?>