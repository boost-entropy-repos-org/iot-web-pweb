<!-- CABECERA -->
<?php include('components/header.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<div class="chart_container">
    <canvas id="sensorChart"></canvas>
</div>

<script defer>
    var ctx = document.getElementById('sensorChart').getContext('2d');

    $.getJSON("http://iot-web-pweb.test/channelJSON/21", function (data) {
        console.log(data);

        let times = data.map(value => value[0]);
        let sensorData = data.map(value => value[1]);

        var config = {
            type: 'line',
            data: {
                labels: times,
                datasets: [{
                    label: "Datos del canal",
                    data: sensorData,
                    backgroundColor: 'rgba(0, 119, 204, 0.3)'
                }]
            },
            options: {
                scales: {
                    x: [{
                        ticks: {
                            display: false
                        },
                        type: 'time',
                        time: {
                            unit: 'day'
                        }
                    }]
                },
            }
        };

        var sensorChart = new Chart(ctx, config);
    });
</script>

