window.onload = function(){
    updateTemp();
    updateMove();
    //updateTable();
    checkSub();
    liveUpdates();
};

function updateTemp(){
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
}

function updateMove(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("accel").innerHTML = this.responseText;
        }
        };
        xmlhttp.open("GET", "./php/accel_select.php", true);
        xmlhttp.send();
}

function liveUpdates(){
    setInterval(function(){
        updateTemp();
        updateMove();
    },1000);
}

function checkSub(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var tempLbl = document.getElementById("subscribe");
            if(this.responseText == "1"){
                tempLbl.classList.remove("colorUnsubbed");
                tempLbl.classList.add("colorSubbed");
            }
            else{
                tempLbl.classList.remove("colorSubbed");
                tempLbl.classList.add("colorUnsubbed");
            }
        }
        };
        xmlhttp.open("GET", "./php/checkSub.php", true);
        xmlhttp.send();
}

function subUser(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var tempLbl = document.getElementById("subscribe");
            if(this.responseText == "remove"){
                if(confirm("Are you sure you want to unsubscribe?")){
                    unsubUser();
                }
                else{
                    console.log("canceled");
                }
            }
            else if(this.responseText == "added"){
                alert("You have been subscribed");
                tempLbl.classList.remove("colorUnsubbed");
                tempLbl.classList.add("colorSubbed");
            }
            else{
                console.log("didn't work");
            }
        }
        };
        xmlhttp.open("GET", "./php/subscribe.php", true);
        xmlhttp.send();
}

function unsubUser(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var tempLbl = document.getElementById("subscribe");
            if(this.responseText == "unsubbed"){
                alert("You have been unsubscribed");
                tempLbl.classList.remove("colorSubbed");
                tempLbl.classList.add("colorUnsubbed");
            }
            else{
                console.log(this.responseText);
            }
        }
        };
        xmlhttp.open("GET", "./php/unsubscribe.php", true);
        xmlhttp.send();
}

function updateTable(){
    $.getJSON("../php/getTable.php", function(result){
            $.each(result, function(key, events){
                console.log(events);
                var tempFields = document.getElementsByClassName("tempData");
                var accelFields = document.getElementsByClassName("accelData");
                var len = events.length;
                for (var i = 0; i < len; i++){
                    if(i=0){
                        tempFields[0].innerHTML = events[i].week;
                        console.log(events[i].week);
                        tempFields[1].innerHTML = events[i].month;
                        tempFields[2].innerHTML = events[i].year;
                    }
                    else{
                        accelFields[0].innerHTML = events[i].week;
                        accelFields[1].innerHTML = events[i].month;
                        accelFields[2].innerHTML = events[i].year;
                    }
                }
            });
    });
}

function settingsClicked(uid){
    window.location = 'settings.php?uid=' + uid;
}

function trendsClicked(uid){
    window.location = 'trends.php?uid=' + uid;
}