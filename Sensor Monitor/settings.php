<?php 
    session_start();
    $servername = "107.180.27.180";
    $username = "MapleLeafAdmin";
    $password = "ClVq0Qzt21jz";
    $dbname = "Mapleleaf_Capstone";
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "SELECT threshold FROM SENSORS WHERE uid='".$_GET["uid"]."'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $threshold = $row['threshold'];
      }
    }
    else {
      echo "0 results";
    }
    $conn->close();
?>

<!-- 

        ArraysAtOne Capstone 2018 - Maple Leaf Foods

        Kevin Baumgartner
        Jesse Berube
        Marc Harquail
        Alex Ireland

        - - - - - - - - - - - - - - - - - - - - - - -

        settings.php

        Marc Harquail
        Alex Ireland

 -->

<!DOCTYPE html>

<!-- HTML -->
<html>

    <!-- Head -->
    <head>
        <?php include 'bodyguard.php' ?>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="./media/maple.png"/>
        <title>Temperature Monitor</title>

        <!-- Style Imports-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./css/style_xs.css">
        <link rel="stylesheet" type="text/css" href="./css/style_sm.css">
        <link rel="stylesheet" type="text/css" href="./css/style_md.css">
        <link rel="stylesheet" type="text/css" href="./css/style_lg.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

        <!-- Script Imports -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <script src="./js/settingsScript.js"></script>
    </head>

    <!-- Body -->
    <body>

        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">

                <!-- Logo -->
                <a href="/"><img id="navbar-image" src="./media/maple.png" alt="logo"></a>

                <!-- Dropdown Menu -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Dropdown Items -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="cabinet?uid=<?php echo $_GET['uid'] ?>">Live View</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Settings<span class="sr-only">(current)</span></a>
                        </li>
                        <?php  include './php/checkforuser.php' ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col cabinetName"><?php include 'php/getCabinetName.php'?></div>
        </div>
        <div class="row">
            <div class="col settingsHeader">Modify Temperature Threshold:</div>
        </div>
        <div class="row">
            <div class="col">
                <!-- Cabinet List -->
                <div class="loginDiv">
                    <input type="range" id="rangeThresh" min='10' max='70' class="slider" value=<?php echo "'".$threshold."'"; ?> oninput="textThresh.innerHTML = rangeThresh.value + '&degC'" >
                    <div class="tempNum" id="textThresh">
                        <?php echo ''.$threshold.'&degC'; ?>
                    </div>
                </div>
                <div class="settingsArea">
                    <button class="settingsButton" onclick="submitClick('<?php include 'php/set_GET_uid.php'?>')">Change Threshold</button>
                    <br>
                    <div id="successDiv">Threshold Changed</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col settingsHeader">Modify Cabinet Name:</div>
        </div>
        <div class="row">
            <div class="col">
                <div id="cabName">
                    <?php include 'php/getCabinetName.php'?>
                </div>
                <div id="cabEdit">
                    <input type='button' class="editButton settingsButton" id="editCabinet" value="Edit" onclick="edit('<?php include 'php/getCabinetName.php'?>');">
                    <input type='button' class="saveButton settingsButton" id="saveCabinet" value="Save" style="display: none" onclick="save('<?php include 'php/set_GET_uid.php'?>');">
                </div>
            </div>
        </div>
    </body>
</html>
