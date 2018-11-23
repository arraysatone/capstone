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