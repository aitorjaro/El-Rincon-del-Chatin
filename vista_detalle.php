<?php if (!defined("CON_CONTROLADOR")) {
    die("<h2>No se puede llamar a este fichero directamente</h2>");
}
?>
<?php include 'plantilla.php' ?>
<!--Vaciamos las sesiones por si se ha realizado un pedido anterior-->
<?php unset($_SESSION['nombre']);
unset($_SESSION['pedido_realizado']); ?>
<?php startblock('titulo'); ?>
<title>
    <?php echo $articulo['nombre'] ?> - El Rincón del Chatín (Hervás)
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
        <section class="seccionImagenDetalle">
            <img class="imagenDetalle"src="data:image/jpeg;base64,<?php echo base64_encode($articulo['imagen']); ?>" />

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
    <script src="/scriptCarrito.js"></script>

</section>

</section>
<?php endblock() ?>