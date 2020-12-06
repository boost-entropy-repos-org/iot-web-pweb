<!-- CABECERA -->
<?php include('components/header.php'); ?>

<div class="contenidoAyuda">
    <main>
        <section id="infoAyuda">
            <h1>Ayuda de MyWebIOT 🔧</h1>
            <article>
                <h2>Servicio web para recoger datos de un canal entre dos fechas determinadas</h2>
                <p>
                    Se ha implementado un servicio web que devuelve los datos del sensor de un canal entre dos fechas determinadas.
                    Para ello, conociendo el id del canal y con dos fechas en formato YY:MM:DD, se obtiene un JSON con los datos
                    de dicho sensor. El formato del URL para usar este servicio es el siguiente:
                </p>
                <code>
                    http://iot-web-pweb.test/getSensorDataBetweenDates?channel={<strong>id</strong>}&date1={<strong>fechaInicio</strong>}&date2={<strong>fechaFinal</strong>}
                </code>
                <br>
                <p>Los campos que se encuentran entre llaves (id, fechainicio, fechafinal) se deben rellenar con los datos de ejemplo</p>
                <h3>Ejemplo</h3>
                <p>Con el siguiente enlace se puede acceder a los datos del sensor del canal 12, entre los días 2020-11-24 al 2020-11-25:</p>
                <a href="http://iot-web-pweb.test/getSensorDataBetweenDates?channel=12&date1=2020-11-24&date2=2020-11-25">
                    http://iot-web-pweb.test/getSensorDataBetweenDates?channel=12&date1=2020-11-24&date2=2020-11-25
                </a>
            </article>
        </section>
    </main>
</div>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
