<!-- CABECERA -->
<?php include('components/header.php'); ?>
<?php include('components/notifications.php'); ?>

<main id="contenidoProducto">

    <a href="/social" id="volverAtras">
        <img src="/images/arrow_back-24px.svg"/>
        <span>Volver a MyWebIoTSocial</span>
    </a>
    <?php
        $userProfile = \App\Models\Profile::where('id_user', session('id'))->first();
    ?>

    <h1>Editar Perfil</h1>

    <div id="productoDetalle">
        <div id="productoImagen">
            <img class="imagenProducto" src="<?php echo $userProfile->img ?>" width="200" height="auto">
        </div>
        <div id="infoProducto">
            <form method="post" action="/social/procesarEditarPerfil" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <table class="formularioTabla">
                    <tr>
                        <td><strong>Estado</strong></td>
                        <td>
                            <textarea placeholder="<?php echo $userProfile->description ?>" name="description" rows="4" cols="50"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Imagen de perfil</strong></td>
                        <td>
                            <input type="file" name="imagenPerfil"/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div id="botonesEditarProducto">
                                <button type="submit" class="boton">Editar Perfil</button>
                                <button type="reset" class="boton" id="restablecerBtn">Restablecer</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>


</main>


<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
