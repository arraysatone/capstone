window.onload = function() {

    $.ajax({
        url : "http://arraysatone.com/fetchTrends.php",
        type : "GET",
        success : function(data){
            console.log(data);

            var temps = {
                recentTemps : [],
                recentTimes : []
            };

            var len = data.length;

            for (var i = 0; i < len; i++){
                temps.recentTemps.push(data[i].temp);
                temps.recentTimes.push(data[i].time);
            }
            console.log(temps.recent);
            //get canvas
            var ctx = document.getElementById('myChart').getContext('2d');

            var data = {
                labels: temps.recentTimes,
                datasets : [
                    {
                        label : "Recent Temperatures",
                        data : temps.recentTemps,
                        backgroundColor: 'rgb(55, 61, 66)',
                        borderColor: 'rgb(255,255,255)'
                    }
                ]
            };

            var options = {
                title: {
                    display: true,
                    text: 'Hourly',
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

function shareEmail() {
    var timeStamp = new Date();
    var readableTime = timeStamp.toDateString();
    var email = 'mharquail95@gmail.com';
    var subject = 'Report for ' + timeStamp;
    var emailBody = 'Hey Marc, here is the latest report on the cabinets';
    document.location = "mailto:"+email+"?subject="+subject+"&body="+emailBody;
}