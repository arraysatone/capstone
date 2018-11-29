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
*    userList.js
*    
*    Jesse Berube
*
*/
	
	
	function edit(id)	
	{
		
		document.getElementById("statusVal"+id).disabled = false;

		var firstName = document.getElementById("firstNameVal"+id).innerHTML;
		var lastName = document.getElementById("lastNameVal"+id).innerHTML;
		var username = document.getElementById("usernameVal"+id).innerHTML;
		
		document.getElementById("firstNameVal"+id).innerHTML="<input type='text' class='userEditField' id='firstNameInput"+id+"' value='"+firstName+"'>";
		document.getElementById("lastNameVal"+id).innerHTML="<input type='text' class='userEditField' id='lastNameInput"+id+"' value='"+lastName+"'>";
		document.getElementById("usernameVal"+id).innerHTML="<input type='text' class='userEditField' id='usernameInput"+id+"' value='"+username+"'>";
		
		
		document.getElementById("editButton"+id).style.display="none";
		document.getElementById("saveButton"+id).style.display="inline";
		document.getElementById("deleteButton"+id).style.display="inline";
	}

	function save(id)
	{
		document.getElementById("statusVal"+id).disabled = true;
		
		var firstName = document.getElementById("firstNameInput"+id).value;
		var lastName = document.getElementById("lastNameInput"+id).value;
		var usernameTemp = document.getElementById("usernameInput"+id).value;
		var username = usernameTemp.replace(/ /g,'');
		
		if(document.getElementById("statusVal"+id).checked)
		{
			status = 1;
		}
		else
		{
			status = 0;
		}
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
				
					
					document.getElementById("editButton"+id).style.display="inline";
					document.getElementById("saveButton"+id).style.display="none";
					document.getElementById("deleteButton"+id).style.display="none";

				}else{
				alert(response);
				}
			}
			
		});
	}

	function deleteR(id)
	{
		if(confirm("Are You Sure You Want To Delete This User?"))
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