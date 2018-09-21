window.onload = function() {
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ["1:00", "2:00", "3:00", "5:00", "6:00", "7:00", "8:00"],
            datasets: [{
                label: "Temperature/Time",
                backgroundColor: 'rgb(55, 61, 66)',
                borderColor: 'rgb(255,255,255)',
                data: [20, 22, 24, 21, 23, 26, 22],
            }]
        },

        // Configuration options go here
        options: {
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
    });
    var ctx = document.getElementById('dailyChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            datasets: [{
                label: "Temperature/Time",
                backgroundColor: 'rgb(55, 61, 66)',
                borderColor: 'rgb(255,255,255)',
                data: [24, 23, 23, 24, 22, 24, 23],
            }]
        },

        // Configuration options go here
        options: {
            title: {
                display: true,
                text: 'Daily Average',
                fontColor: "white",
                fontSize: 25
            },
            legend: {
                position: "bottom",
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
                        stepSize: 5,
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
    });
    var ctx = document.getElementById('WeeklyChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ["02/26", "03/05", "03/12", "03/19", "03/26", "04/02", "04/09"],
            datasets: [{
                label: "Temperature/Time",
                backgroundColor: 'rgb(55, 61, 66)',
                borderColor: 'rgb(255,255,255)',
                data: [24, 24, 23, 24, 25, 24, 24]
            }]
        },

        // Configuration options go here
        options: {
            title: {
                display: true,
                text: 'Weekly Average',
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
                        stepSize: 5,
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
    });
}

function newDoc() {
    window.location.assign("index.html")
}