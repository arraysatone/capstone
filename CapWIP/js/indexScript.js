setInterval(function(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var btnElement = document.getElementById("cab1");
            var tmpElement = document.getElementById("cab1Temp");
            var classString = this.responseText.substring(0,9);
            var tempString = this.responseText.substring(9);
            btnElement.classList.remove("btn-sq-rd","btn-sq-nm","btn-sq-yl");
            btnElement.classList.add(classString);
            tmpElement.innerHTML = tempString;

        }
        };
        xmlhttp.open("GET", "./php/indexTemp.php", true);
        xmlhttp.send();
},1000);