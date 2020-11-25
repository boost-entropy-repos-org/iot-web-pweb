<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Datos del sensor</title>
    <style type="text/css">
    </style>
</head>
<body>

<script type="text/javascript" src="/js/src/highcharts.js"></script>
<script type="text/javascript" src="/js/src/modules/data.js"></script>
<script type="text/javascript" src="/js/src/modules/exporting.js"></script>
<script type="text/javascript" src="/js/src/modules/export-data.js"></script>

<?php
    $titulo ="Datos del canal " . $id;
    $serie='Datos';
?>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


<script type="text/javascript">
    let channelID = <?php echo $id ?>;
    Highcharts.getJSON(
        '/channelJSON/' + channelID,
        function (data) {

            Highcharts.chart('container', {
                chart: {
                    zoomType: 'x'
                },
                title: {
                    text: '<?= $titulo; ?>'
                },
                subtitle: {
                    text: document.ontouchstart === undefined ?
                        'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
                },
                xAxis: {
                    type: 'datetime'
                },
                yAxis: {
                    title: {
                        text: '<?= $serie; ?>'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        marker: {
                            radius: 2
                        },
                        lineWidth: 1,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        threshold: null
                    }
                },

                series: [{
                    type: 'area',
                    name: 'Temp',
                    data: data
                }]
            });
        }
    );
</script>
</body>

</html>
