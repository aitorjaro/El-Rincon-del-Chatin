<?php
include 'plantilla.php';

?>

<?php startblock('titulo'); ?>
<title>
    Pedido confirmado - El Rincón del Chatín (Hervás)
</title>
<?php endblock() ?>
<?php startblock('estilo'); ?>
<style>
    @import url("../estilo.css");
</style>
<?php endblock() ?>
<?php startblock('contenido') ?>

<section class="englobandoCarrito">

    <section class="centrarCarrito">
        <h1 class="h1carrito">
            PEDIDO CONFIRMADO CON Nº <?php echo $_SESSION['referencia_pedido'] ?>
        </h1>
        <p class="pDatosEnvio">Te hemos enviado un correo electrónico con los detalles del pedido.</p>
        <?php if (isset($_SESSION['nombre'])) { ?>
            <section class="sctDatosEnvio">
                <b>
                    <p class="pDatosEnvio">Datos de envío: </p>
                </b>
                <p class="pDatosEnvio">Nombre: <?php echo $_SESSION["nombre"] ?></p>
                <p class="pDatosEnvio">Apellidos: <?php echo $_SESSION["apellidos"] ?></p>
                <p class="pDatosEnvio">Correo electrónico: <?php echo $_SESSION["email"] ?></p>
                <p class="pDatosEnvio">Teléfono: <?php echo $_SESSION["telefono"] ?></p>
                <p class="pDatosEnvio">Dirección: <?php echo $_SESSION["direccion"] ?></p>
                <p class="pDatosEnvio">Localidad: <?php echo $_SESSION["localidad"] ?></p>
                <p class="pDatosEnvio">Código postal: <?php echo $_SESSION["codigopostal"] ?></p>
            </section>
            <?php if (isset($carrito_mio)) { ?>
                <table>
                    <tr>
                        <th>Artículo</th>
                        <th>Cantidad</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>



                    <?php $total = 0; ?>
                    <?php for ($i = 0; $i <= count($carrito_mio) - 1; $i++) { ?>
                        <tr>
                            <td class="tdImagen">
                                <section class="englobarImagenArticuloCarrito">
                                    <a href="/index.php/articulo?id=<?php echo $carrito_mio[$i]['id'] ?>">
                                        <img class="imagenArticuloCarrito"
                                            src="data:image/jpeg;base64,<?php echo base64_encode($carrito_mio[$i]['imagen']); ?>">
                                    </a>
                                </section>
                            </td>
                            <td class="tdCantidad">
                                <form class="formularioCantidad" action="/index.php/carrito" method="post">
                                    <input name="id" type="hidden" value="<?php echo $carrito_mio[$i]['id'] ?>" />
                                    <input name="actualizar" type="hidden" value="" />
                                    <input name="cantidad" type="number" class="inputCantidadCarrito" readonly
                                        value="<?php echo $carrito_mio[$i]["cantidad"] ?>" size="10" min="1" />
                                </form>
                            </td>
                            <td class="tdNombre">
                                <p class="nombreArticulosCarrito">
                                    <?php echo $carrito_mio[$i]["nombre"]; ?>
                                </p>
                            </td>
                            <td>
                                <p class="nombreArticulosCarrito">
                                    <?php
                                    $precioArticulo = $carrito_mio[$i]["precio"] * $carrito_mio[$i]["cantidad"];
                                    echo number_format($precioArticulo, 2, ',', '.') . "€"; // Formatea el número con 2 decimales
                                    echo "<br/>";
                                    ?>
                                </p>
                            </td>
                        </tr>

                        <?php $total = $total + ($carrito_mio[$i]["precio"] * $carrito_mio[$i]["cantidad"]);
                        $_SESSION["totalSinEnvio"] = $total; ?>
                    <?php } ?>
                </table>
                <section class="pieDeCarrito">
                    <section class="pieDeCarritoDentro">
                        <p class="totalProductosCarrito">
                            <?php echo "Total de productos: " . $total_articulos; ?>
                        </p>
                        <p class="totalPrecioCarrito">Precio total:
                            <?php echo number_format($total, 2, ',', '.') ?>€
                        </p>
                        <p class="totalProductosCarrito">
                            Envío: <?php echo $_SESSION["envio"] ?>€ (solo península)
                        </p>
                        <p class="totalPrecioCarrito">Total con envío:
                            <?php
                            echo number_format($_SESSION["totalConEnvio"], 2, ',', '.') ?>€ (IVA inc)
                        </p>
                    </section>
                </section>
            <?php } ?>
        <?php } ?>
    </section>

</section>
<?php //Vaciar el carrito
unset($_SESSION["carrito"]); ?>
<?php endblock() ?>