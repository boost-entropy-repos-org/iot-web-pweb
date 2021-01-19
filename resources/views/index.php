<!-- CABECERA -->
<?php include('components/header.php'); ?>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="/scripts/plotSensorData.js"></script>

<?php include('components/notifications.php'); ?>


<script>
    function get_num_users() {
        $('#numUsuarios').load('getNumUsers');
        setTimeout(get_num_users, 2000);
    }

    function get_num_channels() {
        $('#numCanales').load('getNumCanales');
        setTimeout(get_num_channels, 2000);
    }

    function get_sizeDB() {
        $('#sizeDB').load('getSizeDB');
        setTimeout(get_sizeDB, 2000);
    }
</script>

<aside id="lateral">
    <span>Usuarios creados: <div id="numUsuarios">numusers</div></span><br>
    <span>Canales activos: <div id="numCanales">numCanales</div></span><br>
    <span>Tamaño de BBDD en KB: </span><div id="sizeDB">MBAlmacenados</div><br>

    <script>
        get_num_users();
        get_num_channels();
        get_sizeDB();
    </script>
</aside>

<main id="contenidoInicio">
    <section id="presentacion">
        <h1>Plataforma web de IoT</h1>
        <article>
            <p>
                Una de las principales aplicaciones que tiene el internet de las cosas es la
                monitorización de las variables propias de un entorno o los condicionantes que
                determinan el rendimiento o éxito en el desempeño de una actividad, como puede ser el
                control del funcionamiento de una máquina en una empresa
            </p>
            <div id="areaBoton">
                <?php
                    $usuario = session('username');
                    if(isset($usuario)) {
                        echo '<a href="canales"><button type="button" class="boton">Ver canales</button></a>';
                    } else {
                        echo '<a href="registro"><button type="button" class="boton">Empieza ya</button></a>';
                    }
                ?>
            </div>
        </article>
    </section>

    <section id="ultimosCanales">
        <h2>Últimos canales</h2>
        <div id="graficas">
            <div class="infoGraficaCanal">
                <canvas id="sensorChart2"></canvas>
                <script>
                    $.get('getUltimosCanales', function (data) {
                        plotSensorData("sensorChart2", data[0].id, data[0].channel_name);
                    });
                </script>
            </div>
            <div class="infoGraficaCanal">
                    <canvas id="sensorChartGrafica"></canvas>
                <script>
                    $.get('getUltimosCanales', function (data) {
                        plotSensorData("sensorChartGrafica", data[1].id, data[1].channel_name);
                    });
                </script>
            </div>
        </div>
    </section>
</main>



<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
