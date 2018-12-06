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
*    cabinetScript.js
*    
*    Marc Harquail
*
*/

window.onload = function(){
    var urlParams = new URLSearchParams(window.location.search);
    var uid = urlParams.get('uid');
    updateData(uid);
    checkSub();
    updateTable();
};

/////////////////////////////////////////////////////////
function updateData(uid){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var myArr = JSON.parse(this.responseText);
            if(myArr['status'] == "success"){
                var temp = myArr['temp'];
                var move = myArr['move'];
                var thresh = myArr['thresh'];
                var time = myArr['time'];
                updateTemp(temp, thresh);
                updateTime(time);
                updateMove(move, time);
                console.log(time);
                if(myArr['maxStatus'] == "success"){
                    var maxTemp = myArr['maxTemp'];
                    var minTemp = myArr['minTemp'];
                    console.log()
                    updateExtremums(maxTemp, minTemp);
                }
                else{
                    console.log("Extremum Status: " + myArr['maxStatus']);
                }
            }
            else{
                console.log("Status: " + myArr['status']);
            }
        }
        };
        xmlhttp.open("GET", "./php/cabinetData.php?uid=" + uid, true);
        xmlhttp.send();
};

function updateTemp(temp, thresh){
    $('.temp').html(temp.substring(0,2) + "&degC");
    if(temp >= thresh){
        $('.temp').removeClass("colorSafe");
        $('.temp').addClass("colorUnsafe");
    }
    else{
        $('.temp').removeClass("colorUnsafe");
        $('.temp').addClass("colorSafe");
    }

}

function updateTime(time){
    var date = new Date(time);
    $('.timeLbl').html(date.getHours()+":"+date.getMinutes());
}

function updateMove(move, time){
    if(move == 0){
        $('.accel').removeClass("colorUnsafe");
        $('.accel').addClass("colorNeutral");
        $('.accel').html("No Movement Detected");
    }
    else{
        $('.accel').removeClass("colorNeutral");
        $('.accel').addClass("colorUnsafe");
        $('.accel').html("Movement Detected");
    }
}

function updateExtremums(max, min){
    console.log(max + " " + min);
    $(".maxTemp").html(max.substring(0,2) + "&degC");
    $(".minTemp").html(min.substring(0,2) + "&degC");
}

/////////////////////////////////////////////////////////////////////////////////////////////////


// function updateTemp(){
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("temp").innerHTML = this.responseText.substring(0,35);
//             document.getElementById("time").innerHTML = this.responseText.substring(35,40);
//             document.getElementById("maxTemp").innerHTML = this.responseText.substring(40,134);
//             document.getElementById("minTemp").innerHTML = this.responseText.substring(134,228);
//         }
//         };
//         xmlhttp.open("GET", "./php/temp_select.php", true);
//         xmlhttp.send();
// }

// function updateMove(){
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("accel").innerHTML = this.responseText;
//         }
//         };
//         xmlhttp.open("GET", "./php/accel_select.php", true);
//         xmlhttp.send();
// }

// function liveUpdates(){
//     setInterval(function(){
//         updateTemp();
//         updateMove();
//     },1000);
// }

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
                console.log(this.responseText);
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
    var myArr;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                myArr = JSON.parse(this.responseText);
                writeTable(myArr);
            }
    };
    xmlhttp.open("GET", "./php/getTable.php", true);
    xmlhttp.send();
}

function writeTable(arr){
    var i;
    var tempFields = document.getElementsByClassName("tempData");
    var accelFields = document.getElementsByClassName("accelData");
    for(i = 0; i < arr.length; i++) {
        if(i==0){
            tempFields[0].innerHTML = arr[i].week;
            tempFields[1].innerHTML = arr[i].month;
            tempFields[2].innerHTML = arr[i].year;
        }
        else{
            accelFields[0].innerHTML = arr[i].week;
            accelFields[1].innerHTML = arr[i].month;
            accelFields[2].innerHTML = arr[i].month;
        }
        
    }
}

function settingsClicked(uid){
    window.location = 'settings.php?uid=' + uid;
}

function trendsClicked(uid){
    window.location = 'trends.php?uid=' + uid;
}