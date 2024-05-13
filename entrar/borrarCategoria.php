<?php
session_start();
require "modelo.php";

if (isset($_SESSION["usuario"])) {

} else {
    header("Location: index.php");
    die();
}
//Método GET
$nombreCategoria = $_GET['id'];
$categoria = cargar_categoria_id($nombreCategoria);
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar categoría</title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section>
        <h1 class='h1Anadir'>Borrar categoría</h1>
    </section>
    <section class="englobarMenu">
        <a class="flechaVolver" href="sesion.php">
            < Volver</a>
            <a class="flechaVolver" href="salir.php">
            <img src="/imagenes/logout.png"/></a>
    </section>
    <?php
    if (isset($_GET['mensaje'])) {
        $mensaje = urldecode($_GET['mensaje']);
        echo "<center>$mensaje</center></br></br>";
    } ?>
    <section class="cuerpo">
        <form class="dos" action="categoriaBorrada.php?id=<?php echo $nombreCategoria; ?>" method="post"
            enctype="multipart/form-data">
            <label>¿Seguro que quieres borrar la categoría <?php echo $categoria["categoria"] ?>?</label>
            <p> Esto conlleva que se borren todos los productos que pertenecen a esta categoría. </p>

            <input type="submit" class="inptAnadirProductos" value="Borrar categoría" />


        </form>


    </section>
</body>

</html>