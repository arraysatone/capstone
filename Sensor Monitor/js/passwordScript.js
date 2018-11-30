function changePassword(){
	if(confirm()){
		var postData = {
			"pass" : document.getElementById("old").value,
			"newpass" : document.getElementById("new").value
		};
		$.post("php/changePass.php",postData,function(data,status){
			console.log("Data: " + data + "\nStatus: " + status);
			if (data == "success"){
				console.log("Success");
				passwordChangeSuccess();
			}
			else if(data == "Password Incorrect"){
				incorrectPassword();
			}
		});
	}
}

function confirm(){
	if($("#new").val() == $("#newconfirm").val()){
		console.log("Pass Match");
		return true;
	}
	passwordNoMatch();
	return false;
}

function redirect(url){
	window.location.replace(url);
}

function incorrectPassword(){
	alert("Password is Incorrect!");
}

function passwordNoMatch(){
	alert("New Passwords Do Not Match!");
}

function passwordChangeSuccess(){
	alert("Password Changed Successfully");
}