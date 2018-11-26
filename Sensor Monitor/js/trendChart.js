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
*    trendChart.js
*    
*    Kevin Baumgartner
*    Marc Harquail
*
*/

/* Global Variables */
var before;
var after;

/* Date Formatting */
var today = new Date();
var dd = today.getDate()+1;
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();

if(dd<10) {
    dd = '0'+dd
} 

if(mm<10) {
    mm = '0'+mm
} 

today = yyyy + '-' + mm + '-' + dd;

/* Past 5 */
var past = new Date();
var dd5 = past.getDate()-5;
var mm5 = past.getMonth()+1;
var yyyy5 = past.getFullYear();

if(dd5<10) {
    dd = '0'+dd
} 

if(mm5<10) {
    mm = '0'+mm
} 

past = yyyy5 + '-' + mm5 + '-' + dd5;

window.onload = function() {
    before = document.getElementById('recTempBefore');
    after = document.getElementById('recTempAfter');
    before.value = past;
    after.value = today;
    updateTemperatures();
    updateMovements();
}

function changeTempRange(){
    var preAfter = after.value;
    var strSub = after.value
    strSub = strSub.substring(0,8);

    var strDay = after.value;
    strDay = strDay.substring(8,10);
    strDay = parseInt(strDay) + 1;

    var strFix = strSub + strDay + "";

    if(before.value === ''){
        alert("Please select a Valid Date for the Start Date.")
    }
    else if(after.value === ''){
        alert("Please select a Valid Date for the End Date.")
    }
    else if(after.value < before.value){
        alert("Start Date cannot be before the End Date.");
        after.value = today;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            updateTemperatures();
        }
        };
        xmlhttp.open("GET", "./php/fetchTrends.php?before=" + before.value + "&after=" + strFix, true);
        xmlhttp.send();

}

function updateTemperatures(){

    var strSub = after.value
    strSub = strSub.substring(0,8);

    var strDay = after.value;
    strDay = strDay.substring(8,10);
    strDay = parseInt(strDay) + 1;

    var strFix = strSub + strDay + "";

    $.ajax({
        url : "./php/fetchTrends.php?before=" + before.value + "&after=" + strFix,
        type : "GET",
        success : function(data){
            console.log(data);

            var temps = {
                recentTemps : [],
                recentTimes : [],
                recentMovements : []
            };

            var len = data.length;

            for (var i = 0; i < len; i++){
                temps.recentTemps.push(data[i].temp);
                temps.recentTimes.push(data[i].time);
            }
            console.log(temps.recent);
            //get canvas
            var ctx = document.getElementById('recTemp').getContext('2d');

            var data = {
                labels: temps.recentTimes,
                datasets : [
                    {
                        label : "Recent Temperatures",
                        data : temps.recentTemps,
                        borderWidth: 3,
                        backgroundColor: 'rgb(55, 61, 66)',
                        borderColor: 'rgb(255,255,255)'
                    }
                ]
            };

            var options = {
                title: {
                    display: true,
                    text: '5 Most Recent Entries',
                    fontColor: "white",
                    fontSize: 25
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        fontColor: "white",
                        fontSize: 18
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "white",
                            fontSize: 18,
                            stepSize: 3,
                            beginAtZero: false,
                            suggestedMin: 15,
                            suggestedMax: 30
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            fontColor: "white",
                            fontSize: 14,
                            stepSize: 1,
                            beginAtZero: true
                        }
                    }]
                }
            }

            var chart = new Chart( ctx, {
                type : "line",
                data : data,
                options : options
            } );

        },
        error : function(data) {
            console.log(data);
        }
    });
}

function updateMovements(){
    $.ajax({
        url : "./php/fetchMovements.php",
        type : "GET",
        success : function(data){
            console.log(data);

            var temps = {
                recentDays : [],
                recentMovements : []
            };

            var len = data.length;

            for (var i = 0; i < len; i++){
                temps.recentDays.push(data[i].day);
                temps.recentMovements.push(data[i].movement);
            }
            console.log(temps.recent);
            //get canvas
            var ctx = document.getElementById('recMov').getContext('2d');

            var data = {
                labels: temps.recentDays,
                datasets : [
                    {
                        label : "Recent Movements",
                        data : temps.recentMovements,
                        borderWidth: 3,
                        backgroundColor: 'rgb(55, 61, 66)',
                        borderColor: 'rgb(255,255,255)'
                    }
                ]
            };

            var options = {
                title: {
                    display: true,
                    text: 'Last 5 Days',
                    fontColor: "white",
                    fontSize: 25
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        fontColor: "white",
                        fontSize: 18
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "white",
                            fontSize: 18,
                            stepSize: 2,
                            beginAtZero: false,
                            suggestedMin: 0,
                            suggestedMax: 15
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            fontColor: "white",
                            fontSize: 14,
                            stepSize: 1,
                            beginAtZero: true
                        }
                    }]
                }
            }

            var chart = new Chart( ctx, {
                type : "bar",
                data : data,
                options : options
            } );

        },
        error : function(data) {
            console.log(data);
        }
    });
}

function shareEmail() {
    var timeStamp = new Date();
    var readableTime = timeStamp.toDateString();
    var email = 'mharquail95@gmail.com';
    var subject = 'Report for ' + timeStamp;
    var emailBody = 'Hey Marc, here is the latest report on the cabinets';
    document.location = "mailto:"+email+"?subject="+subject+"&body="+emailBody;
}