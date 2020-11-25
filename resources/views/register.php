<!-- CABECERA -->
<?php include('components/header.php'); ?>

<div id="contenido">
    <form id="formularioRegistro" name="registroForm" method="get" action="procesar_registro">
        <table class="formularioTabla">
            <tr>
                <td><label> Nombre </label></td>
                <td>
                    <input type="text" name="username" required/>
            </tr>
            <tr>
                <td><label> Fecha de nacimiento </label></td>
                <td><input type="date" name="date_birth" required/></td>
            </tr>
            <tr>
                <td><label> Email </label></td>
                <td><input type="email" name="email" required/></td>
            </tr>
                <?php
                    if(isset($invalid_email)) {
                        echo "<tr><td></td><td>El email ya se ha registrado</td></tr>";
                        echo "<script>window.alert('Email ya registrado')</script>";
                    }
                ?>
            <tr>
                <td><label> Contraseña </label></td>
                <!--<td><input type="password" name="password" minlength="8" maxlength="14" pattern="[A-Za-z0-9]+" required/></td>-->
                <td>
                    <input type="password" name="password" required/>
                </td>
            </tr>
            <tr>
                <td><label> Repetir contraseña </label></td>
                <td><input type="password" name="repeat_password" required/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="boton" onclick="checkAge()">Registrar</button>
                    <button type="reset" class="boton">Restablecer</button>
                </td>
            </tr>
        </table>
    </form>
</div>

<script src="scripts/scriptCheckAge.js" defer></script>



<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
