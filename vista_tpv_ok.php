<?php
require_once "modelo.php";
include 'plantilla.php';

/*if (!isset($_SESSION['pedido_realizado'])) {
    if (!isset($_SESSION['nombre'])) {
        header('Location: /index.php');
    } else {*/

/*Importar el fichero principal de la librería, tal y como se muestra
a continuación. El comercio debe decidir si la importación desea hacerla con la
función “include” o “required”, según los desarrollos realizados.*/
include "redsysHMAC256_API_PHP_7.0.0/apiRedsys.php";  

/*Definir un objeto de la clase principal de la librería, tal y como se
muestra a continuación:*/
  $miObj = new RedsysAPI; 
  
/*Capturar los parámetros de la notificación on-line:*/
  $version = $_POST["Ds_SignatureVersion"]; 
  $params = $_POST["Ds_MerchantParameters"]; 
  $signatureRecibida = $_POST["Ds_Signature"]; 

/*Decodificar el parámetro Ds_MerchantParameters. Para llevar
a cabo la decodificación de este parámetro, se debe llamar a la
función de la librería “decodeMerchantParameters()”, tal y como
se muestra a continuación:*/
  $decodec = $miObj->decodeMerchantParameters($params); 

/*Una vez se ha realizado la llamada a la función
“decodeMerchantParameters()”, se puede obtener el valor de
cualquier parámetro que sea susceptible de incluirse en la
notificación on-line. Para llevar a cabo la obtención del valor de un
parámetro se debe llamar a la función “getParameter()” de la
librería con el nombre de parámetro, tal y como se muestra a
continuación para obtener el código de respuesta:*/
  $codigoRespuesta = $miObj->getParameters("Ds_Response"); 

/** NOTA IMPORTANTE: Es importante llevar a cabo la
validación de todos los parámetros que se envían en la
comunicación. Para actualizar el estado del pedido de
forma on-line NO debe usarse esta comunicación, sino la
notificación on-line descrita en los otros apartados, ya que
el retorno de la navegación depende de las acciones del
cliente en su navegador.*/

/*Validar el parámetro Ds_Signature. Para llevar a cabo la
validación de este parámetro se debe calcular la firma y
compararla con el parámetro Ds_Signature capturado. Para ello
se debe llamar a la función de la librería
“createMerchantSignatureNotif()” con la clave obtenida del
módulo de administración y el parámetro
Ds_MerchantParameters capturado, tal y como se muestra a
continuación:*/
  $claveModuloAdmin = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; 
  $signatureCalculada = $miObj->createMerchantSignatureNotif($claveModuloAdmin, $params); 

/*Una vez hecho esto, ya se puede validar si el valor de la firma
enviada coincide con el valor de la firma calculada, tal y como se
muestra a continuación:*/
  if ($signatureCalculada === $signatureRecibida) { 
  die("FIRMA OK. Realizar tareas en el servidor");
  } else { 
  die("FIRMA KO. Error, firma inválida"); 
  }
/*
    }
}*/
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
            PEDIDO CONFIRMADO CON Nº <?php echo $_SESSION['referencia_pedido']; ?>
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