<!-- CABECERA -->
<?php include('components/header.php'); ?>

<div class="contenido">
    <main id="pagCanales">
        <section id="listadoCanales">

            <?php
                $nombreUser = session('username');
                if(isset($nombreUser)) {
                    echo '<a href="nuevoCanal"><button type="submit" class="boton" >Nuevo canal</button></a>';
                }
            ?>

            <h2 id="tituloListaCanales">Listado de los canales dados de alta por el usuario</h2>

            <?php
                $userid = session('id');
                if(isset($userid)) {
                    $canales = \App\Models\Channel::where('id_user', session('id'))
                        ->get();
                } else {
                    $canales = \App\Models\Channel::all();
                }

                foreach ($canales as $canal) {
                    echo '<article class="infoCanal">';
                        echo '<div class="textoCanal">';
                            echo '<p>Canal: ' . $canal->channel_name . '</p>';
                            echo '<p>Sensor: ' . $canal->sensor_name . '</p>';
                            echo '<p>Descripción: ' . $canal->description . '</p>';
                            echo '<a href="canales/graficaCanal/' . $canal->id  . '">Enlace a los datos</a>';
                        echo '</div>';
                        if(isset($userid)) {
                            echo '<a href=eliminarCanal/' . $canal->id . '>';
                            echo '<img src="images/icono-borrar.svg" alt="Borrar canal" class="iconoBorrar"/></a>';
                        }
                    echo '</article>';
                }
            ?>

            <div id="paginasCanales">
                <a href="#" class="previous round">&#8249;</a>
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#" class="next round">&#8250;</a>
            </div>
        </section>
    </main>
</div>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>

