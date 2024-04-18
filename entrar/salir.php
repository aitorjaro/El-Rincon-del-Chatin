<?php
session_start();

session_destroy();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesión cerrada</title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section>
        <h1 class='h1Anadir'>Has cerrado sesión</h1>
    </section>
    <section class="englobarMenu">
        <a class="flechaVolver" href="index.php">
            Iniciar sesión</a>
    </section>
    <section class="cuerpo">
        <h2>La sesión ha sido cerrada</h2>
    </section>
</body>

</html>