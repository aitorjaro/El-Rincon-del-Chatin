<?php if (!defined("CON_CONTROLADOR")) {
    die ("<h2>No se puede llamar a este fichero directamente</h2>");
}
?>
<?php include 'plantilla.php' ?>
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
        <section class="imagenYPrecio">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($articulo['imagen']); ?>" width=600px;
            height=600px; />
            <h2 class="precioDescripcion">
            <?php echo $articulo['precio'] ?>€  IVA incluido
        </h2>
        </section>

        <section class="descripcionDentro">
            <h1 class="descripcionArticulo">
                <?php echo $articulo['nombre'] ?>
            </h1>
            
            <h2 class="descripcion">Descripción
            </h2>
            <p class="descripcionArticulo"><?php echo $articulo['descripcion'] ?></p>
            <h2 class="descripcion">Ingredientes
            </h2>
            <button class="carrito">Añadir al carrito</button>
        </section>
    </section>

</section>

</section>
<?php endblock() ?>