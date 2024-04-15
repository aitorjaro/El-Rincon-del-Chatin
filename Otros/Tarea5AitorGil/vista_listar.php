<?php if (!defined("CON_CONTROLADOR")){
    die("<h2>No se puede llamar a este fichero directamente</h2>");
}
?>
<?php include 'plantilla.php' ?>
<?php startblock('titulo'); ?>
    <title>CYBER MONDAY</title>
<?php endblock() ?>
<?php startblock('estilo'); ?>
    <style>
        @import url("estilo.css");
    </style>
<?php endblock() ?>
<?php startblock('contenido') ?>
    <h1>LISTADO DE ARTÍCULOS</h1>
    <section class="articulos">
        <!-- Mostramos una lista de los artículos -->
        <?php foreach ($articulos as $articulo) { ?>
            <section class="articulo">
                <a href="index.php/articulo?id=<?php echo $articulo['id'] ?>">
                    <img height="530px" width="530px" src="<?php echo $articulo['imagen'] ?>" />
                </a>
                </br>
                <a class="titulo" href="index.php/articulo?id=<?php echo $articulo['id'] ?>">
                    <?php echo $articulo['titulo'] ?>
                </a>
                <h2>
                    <?php echo $articulo['precio'] ?>€
                </h2>
            </section>
        <?php } ?>
    </section>
<?php endblock() ?>