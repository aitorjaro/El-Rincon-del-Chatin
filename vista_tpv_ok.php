<?php
require_once "modelo.php";
include 'plantilla.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['pedido_realizado'])) {
    if (!isset($_SESSION['nombre'])) {
        echo '<script type="text/javascript">';
        echo 'window.location.href="/index.php";';
        echo '</script>';
    } else {

        include "redsysHMAC256_API_PHP_7.0.0/apiRedsys.php";

        // Se crea Objeto
        $miObj = new RedsysAPI;


        if (!empty($_POST)) {//URL DE RESP. ONLINE

            $version = $_POST["Ds_SignatureVersion"];
            $datos = $_POST["Ds_MerchantParameters"];
            $signatureRecibida = $_POST["Ds_Signature"];


            $decodec = $miObj->decodeMerchantParameters($datos);
            $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
            $firma = $miObj->createMerchantSignatureNotif($kc, $datos);

            echo PHP_VERSION . "<br/>";
            echo $firma . "<br/>";
            echo $signatureRecibida . "<br/>";
            if ($firma === $signatureRecibida) {
                echo "FIRMA OK";
                $dsResponse = $miObj->getParameter('Ds_Response');
                $numeroPedido = $miObj->getParameter('Ds_Order');

                // Comprobar el estado del pago
                // Los códigos de respuesta menores a 100 indican un pago aceptado
                if ((int) $dsResponse < 100) {
                    echo "El pago ha sido aceptado. Código de respuesta: $dsResponse";

                } else {
                    echo "El pago no ha sido aceptado. Código de respuesta: $dsResponse";
                }
            } else {
                echo "FIRMA KO";
            }
        } else {
            if (!empty($_GET)) {//URL DE RESP. ONLINE

                $version = $_GET["Ds_SignatureVersion"];
                $datos = $_GET["Ds_MerchantParameters"];
                $signatureRecibida = $_GET["Ds_Signature"];


                $decodec = $miObj->decodeMerchantParameters($datos);
                $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
                $firma = $miObj->createMerchantSignatureNotif($kc, $datos);
                
                if ($firma === $signatureRecibida) {
                    $dsResponse = $miObj->getParameter('Ds_Response');
                    $numeroPedido = $miObj->getParameter('Ds_Order');

                    // Comprobar el estado del pago
                    // Los códigos de respuesta menores a 100 indican un pago aceptado
                    if ((int) $dsResponse < 100) { //Pago aceptado
                        $fecha_actual = date('Y-m-d H:i:s');
                        $nombre = $_SESSION["nombre"];
                        $apellidos = $_SESSION["apellidos"];
                        $telefono = $_SESSION["telefono"];
                        $email = $_SESSION["email"];
                        $direccion = $_SESSION["direccion"];
                        $localidad = $_SESSION["localidad"];
                        $codigoPostal = $_SESSION["codigopostal"];
                        $total = $_SESSION["totalSinEnvio"];
                        $totalConEnvio = $_SESSION["totalConEnvio"];

                        //Inserción en la BD
                        $conexion = conexion();
                        $consulta = "INSERT INTO pedidos (referencia, fecha, nombre, apellidos, telefono, email, direccion, localidad, codigoPostal, total,
totalConEnvio) VALUES ('$numeroPedido', '$fecha_actual', '$nombre', '$apellidos', '$telefono', '$email', '$direccion', '$localidad',
'$codigoPostal', '$total', '$totalConEnvio')";

                        $resultado = mysqli_query($conexion, $consulta);
                        //$referencia = mysqli_insert_id($conexion);
                        for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {
                            $articulo_id = $carrito_mio[$i]['id'];
                            $articulo_cantidad = $carrito_mio[$i]["cantidad"];
                            $articulo_precio = $carrito_mio[$i]["precio"];
                            $consulta2 = "INSERT INTO pedido_producto (pedido_id, producto_id, cantidad, precio) VALUES ('$numeroPedido', '$articulo_id', '$articulo_cantidad', '$articulo_precio')"
                            ;
                            $resultado2 = mysqli_query($conexion, $consulta2);
                        }
                        $conexion->close();


                        // Marcar el pedido como realizado
                        $_SESSION['pedido_realizado'] = true;
                        $_SESSION['referencia_pedido'] = $numeroPedido;

                        //Enviar el mail al dueño de la tienda con la confirmación del pedido
                        //Capturar la salida para poder capturar el bucle
                        ob_start();
                        for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {
                            echo $carrito_mio[$i]['nombre'] . '<br/>Cantidad: ' . $carrito_mio[$i]["cantidad"] . '<br/>Precio: ' . " (" . $carrito_mio[$i]["precio"] . "€)<br/><br/> ";
                        }
                        $lista_productos_email = ob_get_clean();
                        $total_email = $_SESSION["totalSinEnvio"];
                        $total_email_envio = $_SESSION["totalConEnvio"];

                        $cabeceras = "MIME-Version: 1.0" . "\r\n";
                        $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $para = 'aitorjaro11@hotmail.com';
                        $asunto = '¡Nuevo pedido ' . $numeroPedido . '!';
                        $cuerpo = "Tienes un nuevo pedido <b>$numeroPedido</b> de <b>$nombre $apellidos</b>.<br><br><b>Nombre:</b>
    $nombre<br><b>Apellidos:</b> $apellidos<br><b>Teléfono:</b> $telefono<br><b>Email:</b> $email<br><b>Dirección:</b>
    $direccion<br><b>Localidad:</b> $localidad<br><b>Código postal:</b> $codigoPostal<br><br> <b>PRODUCTOS:</b><br><br> $lista_productos_email <br><br><b>TOTAL:</b> $total_email € <br><br><b>TOTAL CON ENVÍO:</b> $total_email_envio €";

                        mail($para, $asunto, $cuerpo, $cabeceras);

                        //Enviar mail al comprador
                        $cabeceras = "MIME-Version: 1.0" . "\r\n";
                        $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $para = $_SESSION["email"];
                        $asunto = 'Confirmación de pedido ' . $numeroPedido . ' en El Rincón del Chatín';
                        $cuerpo = "Muchas gracias por comprar en El Rincón del Chatín, <b>$nombre $apellidos</b>. Tu pedido <b>$numeroPedido</b> ha sido confirmado.<br><br><b>Tu nombre:</b>
    $nombre<br><b>Apellidos:</b> $apellidos<br><b>Teléfono:</b> $telefono<br><b>Email:</b> $email<br><b>Dirección:</b>
    $direccion<br><b>Localidad:</b> $localidad<br><b>Código postal:</b> $codigoPostal<br><br> <b>PRODUCTOS ADQUIRIDOS:</b><br><br> $lista_productos_email <br><br><b>TOTAL:</b> $total_email € <br><br><b>TOTAL CON ENVÍO:</b> $total_email_envio €";

                        mail($para, $asunto, $cuerpo, $cabeceras);
                    } else { //Pago denegado
                        echo "El pago no ha sido aceptado. Código de respuesta: $dsResponse";
                    }
                } else {
                    echo "FIRMA KO";
                }
            } else {
                die("No se recibió respuesta");
            }
        }

    }
}
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
                        Envío: 5€
                    </p>
                    <p class="totalPrecioCarrito">Total con envío:
                        <?php $totalConEnvio = $total + 5;
                        $_SESSION["totalConEnvio"] = $totalConEnvio;
                        echo number_format($totalConEnvio, 2, ',', '.') ?>€ (IVA inc)
                    </p>
                </section>
            </section>
        <?php } ?>
    </section>

</section>
<?php //Vaciar el carrito
unset($_SESSION["carrito"]); ?>
<?php endblock() ?>