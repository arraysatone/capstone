window.onload = function() {
    updateTemperatures();
    updateMovements();
    
}

function updateTemperatures(){
    $.ajax({
        url : "./php/fetchTrends.php",
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