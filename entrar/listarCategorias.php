<?php
session_start();
require "modelo.php";

if (isset($_SESSION["usuario"])) {

} else {
    header("Location: index.php");
}


?>
<!DOCTYPE html>
<html>

<head>
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