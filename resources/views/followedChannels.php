<!-- CABECERA -->
<?php include('components/header.php'); ?>

<div id="contenido-social">
    <a href="/social" id="volverAtras">
        <img src="/images/arrow_back-24px.svg"/>
        <span>Volver a MyWebIoT Social</span>
    </a>
    <h1>Canales creados y seguidos</h1>
    <main id="followed-channels">
        <section class="channel-list">
            <?php
                $canales = \Illuminate\Support\Facades\DB::table('channels')
                                        ->join('friends', 'friends.id_friend','=', 'channels.id_user')
                                        ->join('usuarios', 'channels.id_user','=', 'usuarios.id')
                                        ->where('friends.id_user', session('id'))
                                        ->whereNotIn('channels.id_user', [session('id')])
                                        ->select('channels.*', 'usuarios.name as username')
                                        ->paginate(3);
                ?>

            <h2 id="tituloListaCanales">Listado de los canales dados de alta por el usuario</h2>

            <?php

            foreach ($canales as $canal) : ?>
                <article class="infoCanal">
                    <div class="textoCanal">
                        <p><strong>Autor: </strong> <?php echo $canal->username ?> </p>
                        <p><strong>Canal: </strong> <?php echo $canal->channel_name ?> </p>
                        <p><strong>ID del canal: </strong> <?php echo $canal->id ?> </p>
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
