<!-- CABECERA -->
<?php include('components/header.php'); ?>

<?php include('components/notifications.php'); ?>

<div class="contenido">
    <form id="formularioRegistro" method="get" action="añadir_canal">
        <table class="formularioTabla">
            <tr>
                <td><label> Nombre del canal </label></td>
                <td><input type="text" name="nombre_canal" required/></td>
            </tr>
            <tr>
                <td><label> Nombre del sensor </label></td>
                <td><input type="text" name="nombre_sensor" required/></td>
            </tr>
            <tr>
                <td><label> Descripción </label></td>
                <td><input type="text" name="descripcion" required/></td>
            </tr>
            <tr>
                <td><label> Longitud </label></td>
                <td><input type="text" name="longitud" required/></td>
            </tr>
            <tr>
                <td><label> Latitud </label></td>
                <td><input type="text" name="latitud" required/></td>
            </tr>
            <tr>
                <td></td>
                <td id="areaBotonLogin">
                    <button type="submit" class="boton">Añadir canal</button>
                </td>
            </tr>
        </table>
    </form>
</div>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
