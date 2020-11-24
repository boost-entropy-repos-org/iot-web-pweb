<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Plataforma Web para IOT</title>
            <link type="text/css" rel="stylesheet" href="styles/styles.css?v=<?php echo time(); ?>">
            <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Nunito+Sans:wght@700&display=swap" rel="stylesheet">
        </head>
    <body>
    <header id="cabeceraPagina">
        <a href="/"><img id="logo" alt="logo" src="images/logo.svg"></a>
        <nav>
            <ul id="navegacionOpciones">
                <li class="listaNavegacion"><a href="/">Inicio</a></li>
                <li class="listaNavegacion"><a href="canales">Canales</a></li>
                <li class="listaNavegacion"><a href="ayuda">Ayuda</a></li>
                <li class="listaNavegacion"><a href="contacto">Contacto</a></li>
            </ul>

            <ul id="autenticacion">
                <?php
                    $nombreUser = session('username');
                    if(isset($nombreUser)) {
                        echo "<li class='listaNavegacion'><a href='/'>" . $nombreUser . "</a></li>";
                        echo "<li class='listaNavegacion'><a href='cerrar_sesion'>Cerrar Sesión</a></li>";
                    } else {
                        echo "<li class='listaNavegacion'><a href='login'>Login</a></li>";
                        echo "<li class='listaNavegacion'><a href='registro'>Registro</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </header>
