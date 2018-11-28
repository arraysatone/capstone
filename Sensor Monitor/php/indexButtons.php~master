<?php
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
	*    indexButtons.php
	*    
	*    Kevin Baumgartner
	*	 Marc Harquail
	*
	*/
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

  $uidSQL = "SELECT id, uid FROM SENSORS";

  $uidResult = $conn->query($uidSQL);

  //Print data for current temp
  if ($uidResult->num_rows > 0) {
        // output data of each row
    while($row = $uidResult->fetch_assoc()) {
      $id = $row['id'];
      $uid = $row['uid'];
      echo '<button id="'.$uid.'" type="button" class="newBtn newBtn-sq-nm bdrWhite" onclick="btnClick(this.id)">
	            <div class="newBtnTitle">
	               <span class="newBtnTitleText">Cabinet '.$id.'</span><span><i class="newBtnTitleFav colorHidden fas fa-star"></i></span>
	            </div>
	            <hr>
	            <div class="newBtnDisplay">
	                <p class="newBtnDisplayText colorSafe" id="cab2Temp">--&deg</p>
	            </div>
	            <div class="newBtnInfo">
	                <table>
	                    <tr>
	                        <td class="newBtnStatus btnTempStatus colorSafe">
	                            <i class="fas fa-check-circle btnTempSymbol"></i>
	                        </td>
	                        <td class="newBtnText">
	                            <span class="newBtnTempText">Safe Temperature</span>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td class="newBtnStatus btnMoveStatus colorSafe">
	                            <i class="fas fa-check-circle btnMoveSymbol"></i>
	                        </td>
	                        <td class="newBtnText">
	                            <span class="newBtnMotionText">Movement Stable</span>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td class="newBtnStatus btnVoltStatus colorSafe">
	                        	<i class="fas fa-check-circle btnVoltSymbol"></i>
	                        </td>
	                        <td class="newBtnText">
	                            <span class="newBtnVoltText">Voltage Stable</span>
	                        </td>
	                    </tr>
	                </table>
	            </div>
          	</button>';
    }
  }
  else {
    echo "0 results";
  }
  $conn->close();
?>
