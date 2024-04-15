<?php if (!defined("CON_CONTROLADOR")) {
    die("<h2>No se puede llamar a este fichero directamente</h2>");
}
?>
<?php include 'plantilla.php' ?>
<?php



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
                <!--
                <?php if ($total_articulos > 0) { ?>
                    <section class="tabla">
                        <section class="nombreYPrecioCarrito">
                            <p class="articuloYPrecioCarrito">Artículo</p>
                            <p class="articuloYPrecioCarrito">Cantidad</p>
                            <p class="articuloYPrecioCarrito">Nombre</p>
                            <p class="articuloYPrecioCarrito">Precio</p>
                        </section>
                        <hr />
                        <?php $total = 0; ?>
                        <?php for ($i = 0; $i <= count($carrito_mio) - 1; $i++) { ?>
                            <section class="englobarArticulosDentroCarrito">
                                <section class="englobarImagenArticuloCarrito">
                                    <a href="/index.php/articulo?id=<?php echo $carrito_mio[$i]['id'] ?>">
                                        <img class="imagenArticuloCarrito"
                                            src="data:image/jpeg;base64,<?php echo base64_encode($carrito_mio[$i]['imagen']); ?>">
                                    </a>
                                </section>
                                <form class="formularioCantidad" action="/index.php/carrito" method="post">
                                    <input name="id" type="hidden" value="<?php echo $carrito_mio[$i]['id'] ?>" />
                                    <input name="actualizar" type="hidden" value="" />
                                    <input name="cantidad" type="number" class="inputCantidad"
                                        value="<?php echo $carrito_mio[$i]["cantidad"] ?>" size="10" min="1" />
                                    <input type="image" src="/imagenes/refresh.png" />
                                </form>
                                <p class="nombreArticulosCarrito">
                                    <?php echo $carrito_mio[$i]["nombre"]; ?>
                                </p>
                                <p class="nombreArticulosCarrito">
                                    <?php
                                    echo $carrito_mio[$i]["precio"] * $carrito_mio[$i]["cantidad"] . "€";
                                    echo "<br/>";
                                    ?>
                                </p>
                                <form class="formularioCantidad" action="/index.php/carrito" method="post">
                                    <input name="id2" type="hidden" value="<?php echo $carrito_mio[$i]['id'] ?>" />
                                    <input name="borrar" type="hidden" value="" />
                                    <input type="image" src="/imagenes/papelera.png" />
                                </form>
                            </section>
                            <hr />
                            <?php $total = $total + ($carrito_mio[$i]["precio"] * $carrito_mio[$i]["cantidad"]); ?>
                        <?php } ?>
                    </section>
                    <section class="pieDeCarrito">
                        <section class="pieDeCarritoDentro">
                            <p class="totalProductosCarrito">
                                <?php echo "Total de productos: " . $total_articulos; ?>
                            </p>
                            <p class="totalPrecioCarrito">Precio total:
                                <?php echo $total ?>€
                            </p>
                            <a class="vaciarCarrito" href="/vaciar_carrito.php">Vaciar carrito</a>
                        </section>
                    </section>
                <?php } ?>
                        -->
                <?php if ($total_articulos > 0) { ?>

                    <table>
                        <tr>
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Borrar</th>
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
                                        <input name="cantidad" type="number" class="inputCantidadCarrito"
                                            value="<?php echo $carrito_mio[$i]["cantidad"] ?>" size="10" min="1" />
                                        <input type="image" src="/imagenes/refresh.png" />
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
                                <td class="tdBorrar">
                                    <form class="formularioCantidad" action="/index.php/carrito" method="post">
                                        <input name="id2" type="hidden" value="<?php echo $carrito_mio[$i]['id'] ?>" />
                                        <input name="borrar" type="hidden" value="" />
                                        <input type="image" src="/imagenes/papelera.png" />
                                    </form>
                                </td>
                            </tr>

                            <?php $total = $total + ($carrito_mio[$i]["precio"] * $carrito_mio[$i]["cantidad"]); ?>
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
                                Envío: 5€
                            </p>
                            <p class="totalPrecioCarrito">Total con envío:
                                <?php $totalConEnvio = $total + 5;
                                echo number_format($totalConEnvio, 2, ',', '.') ?>€ (IVA inc)
                            </p>
                            <a class="vaciarCarrito" href="/vaciar_carrito.php">Vaciar carrito</a>
                        </section>
                    </section>
                    <h1 class="datosEnvio">Datos de envío</h1>
                    <form class="formDatosEnvio">
                        <div class="divEnglobarDatos">
                            <div>
                               <input name="nombre" placeholder="Nombre"/>
                            </div>
                            <div>
                                <input name="apellidos" placeholder="Apellidos"/>
                            </div>
                            <div>
                                <input name="email" type="mail" placeholder="Correo electrónico"/>
                            </div>
                        </div>
                        <div class="divEnglobarDatos">
                            
                            <div>
                                <input name="telefono" type="tel" placeholder="Teléfono"/>
                            </div>
                            <div>
                                <input name="direccion" type="mail" placeholder="Dirección"/>
                            </div>
                            <div>
                               <input name="piso" type="text" placeholder="Piso"/>
                            </div>
                        </div>
                        <div class="divEnglobarDatos">
                            <div>
                                <input name="codigopostal" type="number" placeholder="Código Postal"/>
                            </div>
                        </div>
                        <div class="divEnglobarDatos">
                            <button type="submit" class="carrito">Ir al pago</button>
                        </div>

                    </form>
                <?php } else { ?>
                    <p class="carritoVacio">El carrito está vacío</p>
                <?php } ?>
            </section>
        </section>



    </section>

</section>
<?php endblock() ?>