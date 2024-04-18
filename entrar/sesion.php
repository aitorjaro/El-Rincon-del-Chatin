<?php
session_start();
//Comprobamos que se ha logeado anteriormente el usuario, y si no, lo devolvemos a la página de login
if (isset($_SESSION["usuario"])) {
    echo "<section> <h1 class='h1Anadir'>Bienvenid@ " . $_SESSION["usuario"] . "</h1></section>";
} else {
    header("Location: index.php");
}

//Asociamos los datos introducidos en el formulario a la sesión activa

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenid@
        <?php echo $_SESSION["usuario"] ?>
    </title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section class="englobarMenu">
        <a class="flechaVolver" href="salir.php">
            <img src="/imagenes/logout.png" /></a>
    </section>
    <section class="cuerpo">
        <section class="cuerpoSesion">
            <h2 class="h2SeleccionPrincipal">PRODUCTOS</h2>
            <a class="seleccionPrincipal" href="anadir.php">Añadir producto</a>
            <a class="seleccionPrincipal" href="listarProductos.php">Modificar productos</a>
            <h2 class="h2SeleccionPrincipal">CATEGORÍAS</h2>
            <a class="seleccionPrincipal" href="anadirCategoria.php">Añadir categoría</a>
            <a class="seleccionPrincipal" href="listarCategorias.php">Modificar categorías</a>
        </section>
    </section>
</body>

</html>