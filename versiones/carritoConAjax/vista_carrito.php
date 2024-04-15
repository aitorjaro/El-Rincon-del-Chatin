<?php if (!defined("CON_CONTROLADOR")) {
    die ("<h2>No se puede llamar a este fichero directamente</h2>");
}
?>
<?php include 'plantilla.php' ?>
<?php

if (isset ($_SESSION["carrito"])) {

    for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {

        if (isset ($carrito_mio[$i])) {

            if ($carrito_mio[$i] != NULL) {

                if (!isset ($carrito_mio["cantidad"])) {
                    $carrito_mio["cantidad"] = "0";
                } else {
                    $carrito_mio["cantidad"] = $carrito_mio["cantidad"];
                }

                $total_cantidad = $carrito_mio["cantidad"];

                $total_cantidad++;

                if (!isset ($totalcantidad)) {
                    $totalcantidad = "0";
                } else {
                    $totalcantidad = $totalcantidad;
                }

                $totalcantidad += $total_cantidad;

            }
        }
    }

}



//declaramos variables

if (!isset ($totalcantidad)) {
    $totalcantidad = "";
} else {
    $totalcantidad = $totalcantidad;
}

?>
<?php startblock('titulo'); ?>
<title>
    Carrito - El Rincón del Chatín (Hervás)
</title>
<?php endblock() ?>
<?php startblock('estilo'); ?>
<style>
    @import url("../estilo.css");
</style>
<?php endblock() ?>
<?php startblock('contenido') ?>

<section class="englobandoCarrito">

    <!-- Mostramos una lista de los artículos -->

    <section class="centrarCarrito">

        <h1 class="carrito">
            CARRITO DE LA COMPRA
        </h1>

        <section class="englobarArticulosCarrito">
            <section class="centrarArticulosCarrito">
                <?php if ($cantidad > 0) { ?>
                    <section class="nombreYPrecioCarrito">
                        <p class="articuloYPrecioCarrito">Artículo</p>
                        <p class="articuloYPrecioCarrito">Precio</p>
                    </section>
                    <hr />
                    <?php for ($i = 0; $i <= count($carrito_mio) - 2; $i++) { ?>
                        <section class="englobarArticulosDentroCarrito">
                            <section class="englobarImagenArticuloCarrito">
                                <img class="imagenArticuloCarrito"
                                    src="data:image/jpeg;base64,<?php echo base64_encode($carrito_mio[$i]['imagen']); ?>">
                            </section>
                            <p class="nombreArticulosCarrito">
                                <?php echo $carrito_mio[$i]["nombre"]; ?>
                            </p>
                            <p class="nombreArticulosCarrito">
                                <?php
                                echo $carrito_mio[$i]["precio"] . "€";
                                echo "<br/>";
                                ?>
                            </p>
                        </section>
                        <hr />
                    <?php } ?>
                    <p class="totalProductosCarrito">
                        <?php echo "Total de productos: " . $cantidad; ?>
                    </p>
                    <p class="totalPrecioCarrito">Precio total:</p>
                <?php } else { ?>
                    <p class="carritoVacio">El carrito está vacío</p>
                <?php } ?>
            </section>
        </section>



    </section>

</section>
<?php endblock() ?>