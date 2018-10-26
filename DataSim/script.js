var temps = [23, 26, 29, 33, 28, 24, 22];
var i = 0;

function ajax(item){
	if(item == "temp"){
		var str = "q=" + encodeURIComponent(temps[i]);
		$.ajax({
			url: "ajaxTemp.php",
			type: "POST",
			cache: false,
			data: str,
			success: function(response){
				console.log(response);
			}
		});
		i++;
		sendData();
	}
	else{
		var str = "q=" + encodeURIComponent("0001203D");
		$.ajax({
			url: "ajaxMove.php",
			type: "POST",
			cache: false,
			data: str,
			success: function(response){
				console.log(response);
			}
		});
	}
}

function sendData(){
	setTimeout(function(){
		var str = "q=" + encodeURIComponent(temps[i]);
		$.ajax({
			url: "ajaxTemp.php",
			type: "POST",
			cache: false,
			data: str,
			success: function(response){
				console.log(response);
			}
		});
		i++;
		if(i<7){
			sendData();
		}			
	}, 20000);
}