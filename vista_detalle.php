<?php if (!defined("CON_CONTROLADOR")) {
    die("<h2>No se puede llamar a este fichero directamente</h2>");
}
?>
<?php include 'plantilla.php' ?>
<?php startblock('titulo'); ?>
<title>
    <?php if (is_null($articulo)) {
        echo "Artículo no encontrado";
    } else {
        echo $articulo['nombre'];
    } ?> - El Rincón del
    Chatín (Hervás)
</title>
<?php endblock() ?>
<?php startblock('estilo'); ?>
<style>
    @import url("../estilo.css");
</style>
<?php endblock() ?>
<?php startblock('contenido') ?>

<section class="englobarDescripcion">

    <!-- Mostramos una lista de los artículos -->

    <section class="articuloDescripcion">
        <?php if (is_null($articulo)) { ?>
            <h2 class="h2NoEncontrado">Artículo no encontrado</h2>
        <?php } else { ?>
            <section class="seccionImagenDetalle">
                <img class="imagenDetalle" src="data:image/jpeg;base64,<?php echo base64_encode($articulo['imagen']); ?>" />

            </section>

            <section class="descripcionDentro">
                <h1 class="descripcionArticulo">
                    <?php echo $articulo['nombre'] ?>
                </h1>
                <p class="pPesoNeto">Contenido: <?php echo $articulo['contenido'] ?></p>
                <h2 class="precioDescripcion">
                    <?php echo $articulo['precio'] ?>€ IVA incluido
                </h2>
                <h2 class="descripcion">Descripción
                </h2>
                <p class="descripcionArticulo">
                    <?php echo $articulo['descripcion'] ?>
                </p>
                <h2 class="descripcion">Cantidad
                </h2>
                <form class="formularioProducto" action="/index.php/carrito" method="post">
                    <input name="idArticulo" type="hidden" value="<?php echo $articulo['id'] ?>" />
                    <input name="cantidadArticulo" class="inputCantidadDetalle" type="number" value="1" min="1" />

                    <button type="submit" class="carrito">Añadir al carrito</button>

                </form>
            </section>
        </section>
    <?php } ?>
    <script src="/scriptCarrito.js"></script>

</section>

</section>
<?php endblock() ?>