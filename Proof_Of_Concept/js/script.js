setInterval(function(){
    console.log("updating!");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("temp").innerHTML = this.responseText.substring(0,36);
            document.getElementById("time").innerHTML = this.responseText.substring(36);
        }
        };
        xmlhttp.open("GET", "./php/temp_select.php", true);
        xmlhttp.send();
},1000);