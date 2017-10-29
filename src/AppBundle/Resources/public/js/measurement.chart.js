var defoultChart = {
    type: 'line',
    data: {
        datasets: [{
            data: []
        }]
    },
    options: {
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                type: "time",
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Date'
                },
                ticks: {
                    major: {
                        fontStyle: "bold",
                        fontColor: "#FF0000"
                    }
                },
                time: {
                    displayFormats: {
                        minute: 'H:mm',
                        millisecond: 'H:mm',
                        hour: 'H:mm'
                    }
                }
            }]
        }

    }
};

var charts = [];


function initMeasurementCharts(beerId) {
    var route = Routing.generate('getMeasurementsForBeer', {id: beerId});
    $.get(route, function (data) {
        data.forEach(function (data) {
            var dataset = [];
            var limit = $('#limit_'+data.id).val();
            var time = moment().subtract(limit, 'minutes');
            data.log_data.forEach(function (log) {
                if (moment(log.create_date).isSameOrAfter(time)) {
                    dataset.push({x: log.create_date, y: log.value})
                    $('#lastDate_'+data.id).html(moment(log.create_date).format('dd-mm-YYYY H:m:s'));
                    $('#lastValue_'+data.id).html(log.value);
                }
            });
            charts[data.id].data.datasets[0].data = dataset;
            charts[data.id].update();
        });
    });
}
