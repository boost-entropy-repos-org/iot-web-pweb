<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Plataforma Web para IOT</title>
    <link type="text/css" rel="stylesheet" href="styles/styles.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Nunito+Sans:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Los datos del registro son:</h1>

    <?php
        echo $usuario["username"];
        if(isset($usuario)) {
            echo "<p>El nombre del usuario es " . $usuario["username"] . "</p>";
        } else {
            echo "<p>Ha habido un error</p>";
        }
    ?>
</body>
