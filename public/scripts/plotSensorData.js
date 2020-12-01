
function plotSensorData(chartID, channelID, channelName) {
    var ctx = document.getElementById(chartID).getContext('2d');
    let url = "http://iot-web-pweb.test/channelJSON/" + channelID

    $.getJSON(url, function (data) {
        console.log(data);

        let times = data.map(value => value[0]);
        let sensorData = data.map(value => value[1]);

        var config = {
            type: 'line',
            data: {
                labels: times,
                datasets: [{
                    label: "Datos del canal: " +  channelName,
                    data: sensorData,
                    backgroundColor: 'rgba(0, 119, 204, 0.3)'
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            display: false
                        }
                    }],
                    x: [{
                        ticks: {
                            display: false
                        }
                    }],
                }
            }
        };

        var sensorChart2 = new Chart(ctx, config);
    });
}
