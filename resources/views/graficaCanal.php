<!-- CABECERA -->
<?php include('components/header.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

<div class="canal">
    <?php
        $canal = \App\Models\Channel::where('id', $id)
            ->first();
        $usuario = \App\Models\Usuario::where('id', $canal->id_user)
            ->first();
    ?>

    <h1><?php echo $canal->channel_name ?></h1>
    <p><strong>Descripción: </strong><?php echo $canal->description?></p>
    <p><strong>Sensor: </strong><?php echo $canal->sensor_name?></p>
    <p><strong>Autor: </strong><?php echo $usuario->name?></p>


</div>

<div class="chart_container">
    <canvas id="sensorChart"></canvas>
</div>

<script defer>
    var ctx = document.getElementById('sensorChart').getContext('2d');
    let url = "http://iot-web-pweb.test/channelJSON/" + <?php echo $id;?>

    $.getJSON(url, function (data) {
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

