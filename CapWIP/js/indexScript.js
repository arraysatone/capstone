window.onload = function(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var btnList = document.getElementById("btnList");
            var classString = this.responseText;
            btnList.innerHTML = "";
            btnList.innerHTML = classString;
        }
    };
    xmlhttp.open("GET", "./php/indexTemp.php", true);
    xmlhttp.send();
};

