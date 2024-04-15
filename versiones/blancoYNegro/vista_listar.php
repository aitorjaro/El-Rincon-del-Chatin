<?php if (!defined("CON_CONTROLADOR")) {
    die ("<h2>No se puede llamar a este fichero directamente</h2>");
}
?>
<?php include 'plantilla.php' ?>
<?php startblock('titulo'); ?>
<title>El Rincón del Chatín - Inicio</title>
<?php endblock() ?>
<?php startblock('estilo'); ?>
<style>
    @import url("estilo.css");
</style>
<?php endblock() ?>
<?php startblock('contenido') ?>
<div class="englobarCesta">
    <section class="cesta">
        <h2>Cestas preparadas</h2>
        <p>Una cesta increible</p>
    </section>
</div>
<div class="filtrar">
    <section>
    <h1 class="parrafos">PRODUCTOS</h1>
    </section>
    <section>
    <?php foreach ($categorias as $categoria) { ?>
        <button class="botonCategorias" data-categoria="<?php echo $categoria['categoria']?>">
            <?php echo $categoria["categoria"] ?>
        </button>
    <?php } ?>
    </section>
</div>
<section class="articulos">
    <!-- Mostramos una lista de los artículos -->
    <?php foreach ($articulos as $articulo) { ?>
        <section class="articulo" data-categoria="<?php echo $articulo['categoria']?>">
            <section class="englobarImagenArticulo">
                <a href="index.php/articulo?id=<?php echo $articulo['id'] ?>">
                    <img class="imagenArticulo" src="data:image/jpeg;base64,<?php echo base64_encode($articulo['imagen']); ?>">

                </a>
            </section>
            </br>
            <section class="englobarTextoArticulo">
                <section class="englobarTextoArticulo2">
                    <a class="titulo" href="index.php/articulo?id=<?php echo $articulo['id'] ?>">
                        <?php echo $articulo['nombre'] ?>
                    </a>
                    <h3>
                        <?php echo $articulo['precio'] ?>€ IVA incluido
                    </h3>
                    <button class="carrito">Añadir al carrito</button>
                </section>
            </section>
        </section>
    <?php } ?>
</section>
<script src="script.js"></script>
<?php endblock() ?>