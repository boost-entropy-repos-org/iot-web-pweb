<!-- CABECERA -->
<?php include('components/header.php'); ?>

<?php if(session('error') != null):?>
    <div class="alertError">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?php echo session('error') ?>
    </div>
<?php endif; ?>

<div class="contenido">
    <img src="images/icono-user.svg" class="iconoUsuario">
    <form id="formularioRegistro" method="post" action="procesar_login">
        <?= csrf_field() ?>
        <table class="formularioTabla">
            <tr>
                <td><label> Email </label></td>
                <td><input type="email" name="email" required/></td>
            </tr>
            <tr>
                <td><label> Contraseña </label></td>
                <td><input type="password" name="password" required/></td>
            </tr>
            <tr>
                <td></td>
                <td id="areaBotonLogin">
                    <button type="submit" class="boton">Entrar</button>
                </td>
            </tr>
        </table>
    </form>
</div>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
