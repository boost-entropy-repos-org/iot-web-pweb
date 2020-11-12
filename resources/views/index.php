<!-- CABECERA -->
<?php include('components/header.php'); ?>

<aside id="lateral">
    <p>Información sobre los diferentes canales desde la BBDD</p>
    <p>Canales creados, usuarios, etc</p>
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
                <a href="register.php"><button type="button" class="boton">Empieza ya</button></a>
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
