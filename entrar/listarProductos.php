<?php
session_start();
define('CON_CONTROLADOR', true);
require "../modelo.php";

if (isset($_SESSION["usuario"])) {

} else {
    header("Location: index.php");
    die();
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar productos</title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section>
        <h1 class='h1Anadir'>Modificar productos</h1>
    </section>
    <section class="englobarMenu">
        <a class="flechaVolver" href="sesion.php">
            < Volver</a>
                <a class="flechaVolver" href="salir.php">
                    <img src="/imagenes/logout.png" /></a>
    </section>
    <section class="cuerpo">
        <form class="dos" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post"
            enctype="multipart/form-data">
            <label>LISTA DE PRODUCTOS </label>
            <?php
            $articulos = listar_articulos();
            usort($articulos, function ($a, $b) {
                return strcmp($a["nombre"], $b["nombre"]);
            });

            foreach ($articulos as $articulo) {
                ?>
                <a href="modificarArticulo.php?id=<?php echo $articulo["id"] ?>">
                    <?php echo $articulo["nombre"] . "<br/>";
            }

            ?>

        </form>

    </section>
</body>

</html>