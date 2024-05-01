<?php if (!defined("CON_CONTROLADOR")) {
    die ("<h2>No se puede llamar a este fichero directamente</h2>");
}

?>
<?php include 'plantilla.php' ?>
<!--Vaciamos las sesiones por si se ha realizado un pedido anterior-->
<?php unset($_SESSION['nombre']);
unset($_SESSION['pedido_realizado']); ?>
<?php startblock('titulo'); ?>
<title>Búsqueda - El Rincón del Chatín </title>
<?php endblock() ?>
<?php startblock('estilo'); ?>
<style>
    @import url("/estilo.css");
</style>
<?php endblock() ?>
<?php startblock('contenido') ?>
<div class="divEspacio"></div>
<div class="englobarProductos">
    <div class="centrarProductos">
        <div class="filtrar">
            <section>
                <h1 class="parrafos">BÚSQUEDA</h1>
            </section>
            
        </div>
        <section class="articulos">
            <!-- Mostramos una lista de los artículos -->
            <?php foreach ($articulos as $articulo) { ?>
                <section class="articulo" data-categoria="<?php echo $articulo['categoria'] ?>">
                    <section class="englobarImagenArticulo">
                        <a href="/index.php/articulo?id=<?php echo $articulo['id'] ?>">
                            <img class="imagenArticulo"
                                src="data:image/jpeg;base64,<?php echo base64_encode($articulo['imagen']); ?>">
                        </a>
                    </section>
                    
                    </br>
                    <section class="englobarTextoArticulo">
                        <section class="englobarTextoArticulo2">
                            <section class="seccionCentrarTextoLista">
                            <a class="titulo" href="/index.php/articulo?id=<?php echo $articulo['id'] ?>">
                                <?php echo $articulo['nombre'] ?>
                            </a>
            
                            <p class="precio">
                                <?php echo $articulo['precio'] ?>€
                                <span class="iva">&nbsp;IVA incluido</span>
                            </p>
                            <form class="formularioProducto" action="/index.php/carrito" method="post">
                                <input name="idArticulo" type="hidden" value="<?php echo $articulo['id'] ?>" />
                                <input name="cantidadArticulo" type="hidden" value="1" />

                                <button type="submit" class="carrito">Añadir al carrito</button>
                                
                            </form>
                            </section>
                        </section>
                    </section>
                </section>
            <?php } ?>
        </section>
    </div>
</div>


<?php endblock() ?>