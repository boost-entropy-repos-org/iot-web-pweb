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
                        ->paginate(3);
                } else {
                    $canales = \Illuminate\Support\Facades\DB::table('channels')
                                ->join('usuarios','channels.id_user', '=', 'usuarios.id')
                                ->select('channels.*', 'usuarios.name')
                                ->paginate(3);
                }

                foreach ($canales->items() as $canal) : ?>
                    <article class="infoCanal">
                        <div class="textoCanal">
                        <?php if(!isset($userid)): ?>
                            <p><strong>Autor: </strong> <?php echo $canal->name ?> </p>
                        <?php endif; ?>
                            <p><strong>Canal: </strong> <?php echo $canal->channel_name ?> </p>
                            <p><strong>Sensor: </strong> <?php echo $canal->sensor_name ?> </p>
                            <p><strong>Descripción: </strong> <?php echo $canal->description ?></p>
                            <a href="/graficaCanal/<?php echo $canal->id ?> ">Enlace a los datos</a>
                        </div>
                        <?php if(isset($userid)): ?>
                            <a href="eliminarCanal/<?php echo $canal->id; ?>">
                            <img src="images/icono-borrar.svg" alt="Borrar canal" class="iconoBorrar"/></a>
                        <?php endif;?>
                    </article>
                <?php endforeach; ?>


            <div id="paginasCanales">
                <a href="<?php echo $canales->previousPageUrl()?>" class="previous round">&#8249;</a>
                <a href="<?php echo $canales->nextPageUrl() ?>" class="next round">&#8250;</a>
            </div>
        </section>
    </main>
</div>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>

