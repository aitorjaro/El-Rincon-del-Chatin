<?php if (!defined("CON_CONTROLADOR")) {
    die("<h2>No se puede llamar a este fichero directamente</h2>");
}
?>
<?php include 'plantilla.php';
if (isset($_POST['submitPayment'])) {
            
    $amount = $_SESSION["totalConEnvio"];
    $_SESSION["nombre"] = $_POST["nombre"];
    $_SESSION["apellidos"] = $_POST["apellidos"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["telefono"] = $_POST["telefono"];
    $_SESSION["direccion"] = $_POST["direccion"];
    $_SESSION["localidad"] = $_POST["localidad"];
    $_SESSION["codigopostal"] = $_POST["codigopostal"];
    
    include "redsysHMAC256_API_PHP_7.0.0/apiRedsys.php";  
    $miObj = new RedsysAPI;
    $code="340620889";
    $terminal="1";
    $moneda="978";
    $trans="0";
    $url="http://www.elrincondelchatin.com/";
    $urlOK="https://www.elrincondelchatin.com/index.php/tpv_ok";
    $urlKO="https://www.elrincondelchatin.com/tpv_ko.php";
    $id=time();
    $amount=$amount * 100;	
    
    // Se Rellenan los campos
    $miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
    $miObj->setParameter("DS_MERCHANT_ORDER",$id);
    $miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$code);
    $miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
    $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
    $miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
    $miObj->setParameter("DS_MERCHANT_MERCHANTURL",$url);
    $miObj->setParameter("DS_MERCHANT_URLOK",$urlOK);
    $miObj->setParameter("DS_MERCHANT_URLKO",$urlKO);

    //Datos de configuración
    $version="HMAC_SHA256_V1";
    $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//Clave recuperada de CANALES
    // Se generan los parámetros de la petición
    $request = "";
    $params = $miObj->createMerchantParameters();
    $signature = $miObj->createMerchantSignature($kc);
    ?>
    <form id="realizarPago" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="post">
        <input type='hidden' name='Ds_SignatureVersion' value='<?php echo $version; ?>'> 
        <input type='hidden' name='Ds_MerchantParameters' value='<?php echo $params; ?>'> 
        <input type='hidden' name='Ds_Signature' value='<?php echo $signature; ?>'> 
    </form>
    <script>
    $(document).ready(function () {
        $("#realizarPago").submit();
    });
    </script>
    <?php
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

    <section class="centrarCarrito">

        <h1 class="h1carrito">
            CARRITO DE LA COMPRA
        </h1>

        <section class="englobarArticulosCarrito">
            <section class="centrarArticulosCarrito">
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
                                        <input type="image" class="imgRefresh" src="/imagenes/refresh.png" />
                                    </form>
                                </td>
                                <td class="tdNombre">
                                    <p class="nombreArticulosCarrito">
                                        <?php echo $carrito_mio[$i]["nombre"]; ?>
                                    </p>
                                </td>
                                <td class="tdPrecio">
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
                                        <input type="image" class="imgDelete" src="/imagenes/papelera.png" />
                                    </form>
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
                                Envío: 5€
                            </p>
                            <p class="totalPrecioCarrito">Total con envío:
                                <?php $totalConEnvio = $total + 5;
                                $_SESSION["totalConEnvio"] = $totalConEnvio;
                                echo number_format($totalConEnvio, 2, ',', '.') ?>€ (IVA inc)
                            </p>
                            <a class="vaciarCarrito" href="/vaciar_carrito.php">Vaciar carrito</a>
                        </section>
                    </section>
                    
<!-- FORMULARIO DE ENVÍO -->

                    <h1 class="datosEnvio">Datos de envío</h1>
                    <form class="formDatosEnvio" action="" method="post">
                        <div class="divEnglobarDatos">
                            <div>
                               <input name="nombre" placeholder="Nombre" required/>
                            </div>
                            <div>
                                <input name="apellidos" placeholder="Apellidos" required/>
                            </div>
                            <div>
                                <input name="email" type="mail" placeholder="Correo electrónico" required/>
                            </div>
                        </div>
                        <div class="divEnglobarDatos">
                            
                            <div>
                                <input name="telefono" type="tel" placeholder="Teléfono" required/>
                            </div>
                            <div>
                                <input name="direccion" type="text" placeholder="Dirección" required/>
                            </div>
                            <div>
                                <input name="localidad" type="text" placeholder="Localidad" required/>
                            </div>
                        </div>
                        <div class="divEnglobarDatos">
                        
                            <div>
                                <input name="codigopostal" type="number" placeholder="Código Postal" required/>
                            </div>
                        </div>
                        <div class="divEnglobarDatos">
                            <button type="submit" name="submitPayment" class="botonPago">Ir al pago</button>
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