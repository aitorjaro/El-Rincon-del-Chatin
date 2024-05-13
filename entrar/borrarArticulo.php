<?php
session_start();
require "modelo.php";

if (isset($_SESSION["usuario"])) {

} else {
    header("Location: index.php");
    die();
}
//Método GET
$idArticulo = $_GET['id'];
$articulo = detalle_articulos($idArticulo);
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar productos</title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section>
        <h1 class='h1Anadir'>Borrar productos</h1>
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
        <form class="dos" action="articuloBorrado.php?id=<?php echo $idArticulo; ?>" method="post"
            enctype="multipart/form-data">
            <label>¿Seguro que quieres borrar el producto <?php echo $articulo["nombre"] ?>? </label>

            <input type="submit" class="inptAnadirProductos" value="Borrar producto" />


        </form>


    </section>
</body>

</html>