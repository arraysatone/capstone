function changePassword(){
	if(confirm){
		var postData = {
			"pass" : document.getElementById("old").value,
			"newpass" : document.getElementById("new").value
		};
		$.post("php/changePass.php",postData,function(data,status){
			console.log("Data: " + data + "\nStatus: " + status);
			if (data == "success"){
				console.log("Success");
				PasswordChangeSuccess();
			}
			else if(data == "Password incorrect"){
				//Placeholder Error Need to replace
			}
			else if(data == "User already exists"){
				// Placeholder Error need to replace
			}
		});
	}
}

function confirm(){
	if($("#new").val() == $("#newconfirm").val()){
		console.log("Pass Match");
		return true;
	}
	PasswordNoMatch();
	return false;
}

function redirect(url){
	window.location.replace(url);
}

function PasswordNoMatch(){
	console.log("No match");
}

function PasswordChangeSuccess(){
	//Show success or something
}