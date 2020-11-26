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
                    $canales = \Illuminate\Support\Facades\DB::table('channels')
                                ->join('usuarios','channels.id_user', '=', 'usuarios.id')
                                ->select('channels.*', 'usuarios.name')
                                ->paginate(3);
                }

                foreach ($canales->items() as $canal) {
                    echo '<article class="infoCanal">';
                        echo '<div class="textoCanal">';
                        if(!isset($userid)) {
                            echo '<p><strong>Autor: </strong>' . $canal->name . '</p>';
                        }
                            echo '<p><strong>Canal: </strong>' . $canal->channel_name . '</p>';
                            echo '<p><strong>Sensor: </strong>' . $canal->sensor_name . '</p>';
                            echo '<p><strong>Descripción: </strong>' . $canal->description . '</p>';
                            echo '<a href="/graficaCanal/' . $canal->id  . '">Enlace a los datos</a>';
                        echo '</div>';
                        if(isset($userid)) {
                            echo '<a href=eliminarCanal/' . $canal->id . '>';
                            echo '<img src="images/icono-borrar.svg" alt="Borrar canal" class="iconoBorrar"/></a>';
                        }
                    echo '</article>';
                }
            ?>

            <div id="paginasCanales">
                <a href="<?php echo $canales->previousPageUrl()?>" class="previous round">&#8249;</a>
                <a href="<?php echo $canales->nextPageUrl() ?>" class="next round">&#8250;</a>
            </div>
        </section>
    </main>
</div>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>

