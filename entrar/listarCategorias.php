<?php
session_start();
require "modelo.php";

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
    <title>Modificar categorías</title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section>
        <h1 class='h1Anadir'>Modificar categorías</h1>
    </section>
    <section class="englobarMenu">
        <a class="flechaVolver" href="sesion.php">
            < Volver</a>
            <a class="flechaVolver" href="salir.php">
            <img src="/imagenes/logout.png" alt="Salir"/></a>
    </section>
    <section class="cuerpo">
        <form class="dos" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post"
            enctype="multipart/form-data">
            <label>LISTA DE CATEGORÍAS </label>
            <?php $categorias = listar_categorias();
            foreach ($categorias as $categoria) { ?>
                <a href="modificarCategoria.php?id=<?php echo $categoria["categoria"] ?>"> <?php echo $categoria["categoria"] . "</a>";
            }
            ?>
        </form>

    </section>
</body>

</html>