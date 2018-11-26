<!DOCTYPE html>



<html>
	<head>
		<!-- 
        ArraysAtOne Capstone 2018 - Maple Leaf Foods

        Kevin Baumgartner
        Jesse Berube
        Marc Harquail
        Alex Ireland
		-->
	
		<!-- Meta -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/png" href="./media/maple.png"/>
		<title>Database Edit</title>
		<!-- Script Imports -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	</head>
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
		  align: "center";
	  }
	  .selected {
		background-color: yellow;
	  }
	  .saveButton{
		  display: none;
	  }
	  #feedback
	  {
		  display:none;
	  }
	  
    </style>
	<body>
		<div id = "tableDiv">
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
			
			$sql = "SELECT * FROM UserTable";
			$result = $conn->query($sql);
		?>
		
		<table id="userTable">
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Username</th>
				<th>Status</th>
			</tr>
		<?php
		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc()) 
			{
		?>
			<tr id="row<?php echo $row['ID'];?>">
				<td id="firstNameVal<?php echo $row['ID'];?>"><?php echo $row['FirstName'];?></td>
				<td id="lastNameVal<?php echo $row['ID'];?>"><?php echo $row['LastName'];?></td>
				<td id="usernameVal<?php echo $row['ID'];?>"><?php echo $row['Username'];?></td>
				<td id="statusVal<?php echo $row['ID'];?>"><?php echo $row['Status'];?></td>
				<td>
				<input type='button' class="editButton" id="editButton<?php echo $row['ID'];?>" value="Edit" onclick="edit('<?php echo $row['ID'];?>');">
				<input type='button' class="saveButton" id="saveButton<?php echo $row['ID'];?>" value="Save" onclick="save('<?php echo $row['ID'];?>');">
				<input type='button' class="deleteButton" id="deleteButton<?php echo $row['ID'];?>" value="Delete" onclick="deleteR('<?php echo $row['ID'];?>');">
				</td>
			</tr>
		<?php
			}
		}
		?>
		<!--
			<tr id="new_row">
				<td><input type="text" id="newFirstName"></td>
				<td><input type="text" id="newLastName"></td>
				<td><input type="text" id="newUsername"></td>
				<td><input type="text" id="newPassword"></td>
				<td><input type="text" id="newStatus"></td>
				<td><input type="button" value="Insert Row" onclick="insert();"></td>
			</tr>
		-->
		</table>

		</div>
	</body>
</html>
		
<script>

	function edit(id)	
	{
		var firstName = document.getElementById("firstNameVal"+id).innerHTML;
		var lastName = document.getElementById("lastNameVal"+id).innerHTML;
		var username = document.getElementById("usernameVal"+id).innerHTML;
		var status = document.getElementById("statusVal"+id).innerHTML;
		
		document.getElementById("firstNameVal"+id).innerHTML="<input type='text' id='firstNameInput"+id+"' value='"+firstName+"'>";
		document.getElementById("lastNameVal"+id).innerHTML="<input type='text' id='lastNameInput"+id+"' value='"+lastName+"'>";
		document.getElementById("usernameVal"+id).innerHTML="<input type='text' id='usernameInput"+id+"' value='"+username+"'>";
		document.getElementById("statusVal"+id).innerHTML="<input type='text' id='statusInput"+id+"' value='"+status+"'>";

		
		document.getElementById("editButton"+id).style.display="none";
		document.getElementById("saveButton"+id).style.display="unset";
	}

	function save(id)
	{
		var firstName = document.getElementById("firstNameInput"+id).value;
		var lastName = document.getElementById("lastNameInput"+id).value;
		var username = document.getElementById("usernameInput"+id).value;
		var status = document.getElementById("statusInput"+id).value;
		
		$.ajax
		({
			type:'post',
			url:'./php/updateUserList.php',
			data:{
				functionName:'UpdateRow',
				rowId:id,
				first:firstName,
				last:lastName,
				user:username,
				stat:status
		},
			success:function(response) {
				if(response=="Record updated successfully")
				{
					document.getElementById("firstNameVal"+id).innerHTML=firstName;
					document.getElementById("lastNameVal"+id).innerHTML=lastName;
					document.getElementById("usernameVal"+id).innerHTML=username;
					document.getElementById("statusVal"+id).innerHTML=status;
				
					
					document.getElementById("editButton"+id).style.display="unset";
					document.getElementById("saveButton"+id).style.display="none";
				}
			}
		});
	}

	function deleteR(id)
	{
		$.ajax
		({
			type:'post',
			url:'./php/updateUserList.php',
			data:{
				functionName:'DeleteRow',
				rowId:id
			},
			success:function(response) {
				if(response=="Record updated successfully")
				{
					var row=document.getElementById("row"+id);
					row.parentNode.removeChild(row);
				}
				else
				{
					alert(response);
				}
			}
		});
	}
	 

	function insert()
	{
		var firstName=document.getElementById("newFirstName").value;
		var lastName=document.getElementById("newLastName").value;
		var username=document.getElementById("newUsername").value;
		var status=document.getElementById("newStatus").value;

		$.ajax
		({
			type:'post',
			url:'./php/updateUserList.php',
			data:{
				functionName:'AddRow',
				first:firstName,
				last:lastName,
				user:username,
				stat:status
				},
				success:function(response) {
					if(response!="")
					{
						var id=response;
						var table=document.getElementById("userTable");
						var table_len=(table.rows.length)-1;
						var row = table.insertRow(table_len).outerHTML="<tr id='row"+id+"'><td id='firstNameVal"+id+"'>"+firstName+"</td><td id='lastNameVal"+id+"'>"+lastName+"</td>"
						+"<td id='usernameVal"+id+"'>"+username+"</td>"
						+"<td id='statusVal"+id+"'>"+status+"</td>"
						+"<td><input type='button' class='editButton' id='editButton"+id+"' value='Edit' onclick='edit("+id+");'/>"
						+"<input type='button' class='saveButton' id='saveButton"+id+"' value='Save' onclick='save("+id+");'/>"
						+"<input type='button' class='deleteButton' id='deleteButton"+id+"' value='Delete' onclick='deleteR("+id+");'/></td></tr>";

						firstName=document.getElementById("newFirstName").value = "";
						lastName=document.getElementById("newLastName").value = "";
						username=document.getElementById("newUsername").value = "";
						status=document.getElementById("newStatus").value = "";
					}
					else
					{
						alert("This Username Already Exists");
					}
				}
			});
	}

</script>
		

