setInterval(function(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("temp").innerHTML = this.responseText.substring(0,36);
            document.getElementById("time").innerHTML = this.responseText.substring(36,41);
            document.getElementById("maxTemp").innerHTML = this.responseText.substring(41,135);
            document.getElementById("minTemp").innerHTML = this.responseText.substring(135,229);
        }
        };
        xmlhttp.open("GET", "./php/temp_select.php", true);
        xmlhttp.send();
},1000);

setInterval(function(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("accel").innerHTML = this.responseText;
        }
        };
        xmlhttp.open("GET", "./php/accel_select.php", true);
        xmlhttp.send();
},1000);

/*setInterval(function(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("accel").innerHTML = this.responseText;
        }
        };
        xmlhttp.open("GET", "./php/indexTemp.php", true);
        xmlhttp.send();
},1000);*/