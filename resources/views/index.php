<!-- CABECERA -->
<?php include('components/header.php'); ?>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="public/js/src/highcharts.js"></script>

<script>
    function get_num_users() {
        $('#numUsuarios').load('getNumUsers');
        setTimeout(get_num_users, 2000);
    }
</script>

<aside id="lateral">
    <p>Información sobre los diferentes canales desde la BBDD</p>
    <p>Canales creados, usuarios, etc</p>
    <span>Número de usuarios creados: </span><div id="numUsuarios">numusers</div>

    <script>
        get_num_users();
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
                        echo '<a href="register"><button type="button" class="boton">Empieza ya</button></a>';
                    }
                ?>
            </div>
        </article>
    </section>

    <section id="ultimosCanales">
        <h2>Últimos canales</h2>
        <div id="graficas">
            <article class="infoGraficaCanal">
                <img id="grafica1" src="images/graficaEjemplo.png"/>
            </article>
            <article class="infoGraficaCanal">
                <img id="grafica2" src="images/graficaEjemplo.png"/>
            </article>
        </div>
    </section>
</main>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
