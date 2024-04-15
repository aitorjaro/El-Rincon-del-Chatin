<?php
session_start();
//Comprobamos que se ha logeado anteriormente el usuario, y si no, lo devolvemos a la página de login
if (isset($_SESSION["usuario"])) {
    echo "<section> <h1>Bienvenid@ " . $_SESSION["usuario"] . "</h1></section>";
} else {
    header("Location: index.php");
}

//Asociamos los datos introducidos en el formulario a la sesión activa

?>
<!DOCTYPE html>
<html>

<head>
    <title>Bienvenid@
        <?php echo $_SESSION["usuario"] ?>
    </title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section class="cuerpo">
        <a href="anadir.php">Añadir producto</a>
        <a href="modificar.php">Modificar producto</a>
        <a href="borrar.php">Borrar producto</a>
    </section>
</body>

</html>