
<?php 
session_start();
$servername = "107.180.27.180";
$username = "MapleLeafAdmin";
$password = "ClVq0Qzt21jz";
$dbname = "Mapleleaf_Capstone";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
else{

}

?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="./media/maple.png"/>
    <title>Database Edit</title>
    <!-- Script Imports -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
	<style>
      table,tr,th,td
      {
        border: 1px solid black;
		user-select: none; 
		-moz-user-select: none; 
		-khtml-user-select: none;
		onselectstart="javascript:return false;
      }
	  table
	  {
		  width: 100%; 
	  }
	  .selected {
		background-color: yellow;
	  }
	  #feedback
	  {
		  display:none;
	  }
	  
    </style>
  </head>
  <body>
    <div>
      <table id="table" >
	  <thead>
        <tr id ="tableHeaders">
          <th>First Name</th>
          <th>Last Name</th>
		  <th>Username	</th>
          <th>Email</th>
        </tr>
       </thead>
		<tbody>
        <?php 
		
				$sql = "SELECT id, firstName, lastName,username, email FROM EMAIL_LIST";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
					echo "<tr><td style='display:none';>".$row['id']."</td><td>". $row['firstName']."</td><td>".$row['lastName']."</td><td>"
					.$row['username']."</td><td>".$row['email']."</td></tr>"; 
					}
				}
				else{
					echo "0 results";
				}
				$conn->close();
			
			
		?>
		</tbody>
      </table>
	  <br>
	  <form>
			*Required<br>
			First Name*: <input type="text" name="fname" placeholder="First Name" required><br>
			Last Name*: <input type="text" name="lname" placeholder="Last Name" required><br>
			Username*: <input type="text" name="uname" placeholder="Username" required><br>
			Email Address*: <input type="email" name="emailAdd"  placeholder="Email Address" required><br>
			
			<input type="button" id="add" class="loginDiv buttons" value="Add">
			<input type="button" id="update" class="loginDiv buttons" value="Update">
			<input type="button" id="remove" class="loginDiv buttons" value="Remove">
	  </form>
    </div>
	<div id = "feedback">Database Successfully Updated</div>
  </body>
</html>


<script>
	$(document).ready(function (){
		$rowId = null;
		$firstname = null;
		$lastname = null;
		$username = null;
		$emailaddress = null;
		
		$('tbody tr').click(function (){
			$('tr').removeClass('selected');
			$(this).addClass('selected');
			var data = $(this).children('td');
			$rowId = data[0].innerText;
			$("input[type=text][name=fname]").val(data[1].innerText);
			$("input[type=text][name=lname]").val(data[2].innerText);
			$("input[type=text][name=uname]").val(data[3].innerText);
			$("input[type=email][name=emailAdd]").val(data[4].innerText);
		});
		
		//Remove Record
		$("#remove").click(function(){
			if($rowId != null){
			$.post("./php/databaseUpdate.php", { id: ""+$rowId, functionName: "DeleteRow"},
			function(data, status){
				location.reload();
			});
			}
			else{alert("Select a row to delete");}
		});
	
		//Add Record
		$("#add").click(function(){
			$firstName = $('[name="fname"]').val();
			$lastName = $('[name="lname"]').val();
			$userName = $('[name="uname"]').val();
			$emailAddress = $('[name="emailAdd"]').val();
			
			//Remove uneeded white space
			$firstName = $firstName.trim();
			$lastName = $lastName.trim();
			$userName = $userName.replace(/ /g,'');
			$emailAddress = $emailAddress.replace(/ /g,'')
			
			var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
			
			if(testEmail.test($emailAddress)){
				if($firstName != ""  && $lastName != "" && $userName != "" && $emailAddress != ""){
					$.post("./php/databaseUpdate.php", {first: ""+$firstName, last: ""+$lastName, user: ""+$userName, 
					email: ""+$emailAddress, functionName: "AddRow"},
					function(data, status){
						location.reload();
					});
				}
				else{alert("Please Fill All Fields");}
			}
			else{alert("Please Enter A Valid Email Address");}
		});
		
		//Update Existing Record
		$("#update").click(function(){
			$firstName = $('[name="fname"]').val();
			$lastName = $('[name="lname"]').val();
			$userName = $('[name="uname"]').val();
			$emailAddress = $('[name="emailAdd"]').val();
			
			var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

			
			//Remove uneeded white space
			$firstName = $firstName.trim();
			$lastName = $lastName.trim();
			$userName = $userName.replace(/ /g,'');
			$emailAddress = $emailAddress.replace(/ /g,'');
			
			if($rowId != null){			
				if($firstName != ""  && $lastName != "" && $userName != "" && $emailAddress != ""){
					if(testEmail.test($emailAddress)){
						$.post("./php/databaseUpdate.php", { id: ""+$rowId, first: ""+$firstName, last: ""+$lastName, user: ""+$userName, 
						email: ""+$emailAddress, functionName: "UpdateRow"},
						function(data, status){
							location.reload();
						});
					}				
					else{alert("Please Enter A Valid Email Address");}
				}
				else{alert("Please Fill All Fields");}
			}
			else{alert("Please Select A Row To Edit");}

		});
	});

</script>



