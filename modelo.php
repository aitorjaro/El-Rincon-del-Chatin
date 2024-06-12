<?php
//Modelo

if (!defined('CON_CONTROLADOR')) {
    die("Acceso no permitido. Este archivo no puede ser llamado directamente.");
}
/**
 * Función cargar_datos
 * Carga los artículos en un array
 * @return array $articulos
 */

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function conexion()
{
    $servidor = $_ENV['DB_HOST'];
    $bbdd = $_ENV['DB_DBNAME'];
    $usuario = $_ENV['DB_USER'];
    $contrasena = $_ENV['DB_PASS'];
    try {
        $conectado = new mysqli($servidor, $usuario, $contrasena, $bbdd);

        if ($conectado->connect_errno) {
            exit("Conexión fallida: " . $conectado->connect_error);
        } else {
            return $conectado;
        }
    } catch (mysqli_sql_exception $excepcion) {
        return null;
    }
}

function cargar_articulos()
{
    $articulos = array();
    $con = conexion();
    if ($con) {
        $stmt = $con->prepare("SELECT * FROM productos");
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($articulo = $resultado->fetch_assoc()) {
            $articulos[] = $articulo;
        }
        $stmt->close();
        $con->close();
    }
    return $articulos;
}

function cargar_articulo_id($id)
{
    $articulo = null;
    $con = conexion();
    if ($con) {

        $stmt = $con->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado) {
            $articulo = $resultado->fetch_assoc();
        }
        $stmt->close();
        $con->close();
    }
    return $articulo;
}

function cargar_categorias()
{
    $categorias = array();
    $con = conexion();
    if ($con) {
        $busqueda = mysqli_query($con, "SELECT * from categorias");
        while ($categoria = mysqli_fetch_assoc($busqueda)) {
            $categorias[] = $categoria;
        }
        $con->close();
    }
    return $categorias;
}
function insertar_pedido()
{

}
function busqueda_articulos($termino)
{
    $articulos = array();
    $con = conexion();
    if ($con) {
        $stmt = $con->prepare("SELECT * FROM productos WHERE nombre LIKE CONCAT('%', ?, '%')");
        $stmt->bind_param("s", $termino);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            while ($articulo = $resultado->fetch_assoc()) {
                $articulos[] = $articulo;
            }
        }
        $stmt->close();
        $con->close();
    }
    return $articulos;
}
function cargar_cestas()
{
    $articulos = array();
    $con = conexion();
    if ($con) {
        $stmt = $con->prepare("SELECT * FROM productos WHERE categoria = 'cestas'");
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($articulo = $resultado->fetch_assoc()) {
            $articulos[] = $articulo;
        }
        $stmt->close();
        $con->close();
    }
    return $articulos;
}

/**
 * Función listar_articulos
 * Devuelve el array de artículos cargado
 * @return array $articulos
 */
function listar_articulos()
{
    $articulos = cargar_articulos();
    return $articulos;
}
/**
 * Función detalle_articulos
 * Devuelve el artículo según el ID que le hayamos pasado como parámetro.
 * @param int $id ID del artículo
 * @return $articulos[$id] 
 */
function detalle_articulos($id)
{
    $articulos = cargar_articulo_id($id);
    return $articulos;
}

function crearParametrosPago()
{
    if (isset($_POST['submitPayment'])) {

        $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";

        // Construye la URL completa
        $url_completa = $protocolo . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

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
        $code = "340620889";
        $terminal = "1";
        $moneda = "978";
        $trans = "0";
        $url = "https://elrincondelchatin.com/";
        if ($url_completa == "https://elrincondelchatin.com/index.php/redireccion") {
            $urlOK = "https://elrincondelchatin.com/index.php/tpv_ok";
        } elseif ($url_completa == "https://www.elrincondelchatin.com/index.php/redireccion") {
            $urlOK = "https://www.elrincondelchatin.com/index.php/tpv_ok";
        } elseif ($url_completa == "http://www.elrincondelchatin.com/index.php/redireccion") {
            $urlOK = "http://www.elrincondelchatin.com/index.php/tpv_ok";
        } elseif ($url_completa == "http://elrincondelchatin.com/index.php/redireccion") {
            $urlOK = "http://elrincondelchatin.com/index.php/tpv_ok";
        }

        $urlKO = "https://elrincondelchatin.com/tpv_ko.php";
        $id = time();
        $amount = $amount * 100;

        // Se Rellenan los campos
        $miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
        $miObj->setParameter("DS_MERCHANT_ORDER", $id);
        $miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $code);
        $miObj->setParameter("DS_MERCHANT_CURRENCY", $moneda);
        $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $trans);
        $miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
        $miObj->setParameter("DS_MERCHANT_MERCHANTURL", $url);
        $miObj->setParameter("DS_MERCHANT_URLOK", $urlOK);
        $miObj->setParameter("DS_MERCHANT_URLKO", $urlKO);

        //Datos de configuración
        $version = "HMAC_SHA256_V1";
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
}

function crearPedido()
{
    session_start();
    if (isset($_SESSION["carrito"])) {

        $carrito_mio = $_SESSION["carrito"];
        $total_articulos = 0;

        foreach ($carrito_mio as $total_articulos_articulo) {
            $total_articulos += $total_articulos_articulo["cantidad"];
        }
    } else {
        $total_articulos = 0;
    }
    if (!isset($_SESSION['pedido_realizado'])) {
        if (!isset($_SESSION['nombre'])) {
            echo '<script type="text/javascript">';
            echo 'window.location.href="/index.php";';
            echo '</script>';
            die();
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
                            $stmt = $conexion->prepare("INSERT INTO pedidos (referencia, fecha, nombre, apellidos, telefono, email, direccion, localidad, codigoPostal, total, totalConEnvio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                            $stmt->bind_param("sssssssssss", $numeroPedido, $fecha_actual, $nombre, $apellidos, $telefono, $email, $direccion, $localidad, $codigoPostal, $total, $totalConEnvio);
                            $stmt->execute();

                            for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {
                                $articulo_nombre = $carrito_mio[$i]['nombre'];
                                $articulo_cantidad = $carrito_mio[$i]["cantidad"];
                                $articulo_precio = $carrito_mio[$i]["precio"];

                                $stmt2 = $conexion->prepare("INSERT INTO pedido_producto (pedido_id, producto_nombre, cantidad, precio) VALUES (?, ?, ?, ?)");
                                $stmt2->bind_param("ssss", $numeroPedido, $articulo_nombre, $articulo_cantidad, $articulo_precio);
                                $stmt2->execute();
                            }

                            $stmt->close();
                            $stmt2->close();
                            $conexion->close();


                            // Marcar el pedido como realizado
                            $_SESSION['pedido_realizado'] = true;
                            $_SESSION['referencia_pedido'] = $numeroPedido;

                            //Enviar el mail al dueño de la tienda con la confirmación del pedido
                            //Capturar la salida para poder capturar el bucle
                            ob_start();
                            for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {
                                echo $carrito_mio[$i]['nombre'] . '<br/>Cantidad: ' . $carrito_mio[$i]["cantidad"] . '<br/>Precio (c/u): ' . $carrito_mio[$i]["precio"] . "€<br/><br/> ";
                            }
                            $lista_productos_email = ob_get_clean();
                            $total_email = $_SESSION["totalSinEnvio"];
                            $total_email_envio = $_SESSION["totalConEnvio"];

                            $cabeceras = "MIME-Version: 1.0" . "\r\n";
                            $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $cabeceras .= "From: tienda@elrincondelchatin.com\r\n";
                            $cabeceras .= "Reply-To: tienda@elrincondelchatin.com\r\n";
                            $para = 'aitorjaro11@hotmail.com';
                            $asunto = '¡Nuevo pedido ' . $numeroPedido . '!';
                            $cuerpo = "Tienes un nuevo pedido <b>$numeroPedido</b> de <b>$nombre $apellidos</b>.<br><br><b>Nombre:</b>
        $nombre<br><b>Apellidos:</b> $apellidos<br><b>Teléfono:</b> $telefono<br><b>Email:</b> $email<br><b>Dirección:</b>
        $direccion<br><b>Localidad:</b> $localidad<br><b>Código postal:</b> $codigoPostal<br><br> <b>PRODUCTOS:</b><br><br> $lista_productos_email <br><br><b>TOTAL:</b> $total_email € <br><br><b>TOTAL CON ENVÍO:</b> $total_email_envio €";

                            mail($para, $asunto, $cuerpo, $cabeceras);

                            //Enviar mail al comprador
                            $cabeceras = "MIME-Version: 1.0" . "\r\n";
                            $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $cabeceras .= "From: tienda@elrincondelchatin.com\r\n";
                            $cabeceras .= "Reply-To: tienda@elrincondelchatin.com\r\n";
                            $para = $_SESSION["email"];
                            $asunto = 'Confirmación de pedido ' . $numeroPedido . ' en El Rincón del Chatín';
                            $cuerpo = "Muchas gracias por comprar en El Rincón del Chatín, <b>$nombre </b>. Tu pedido <b>$numeroPedido</b> ha sido confirmado.<br><br><b>Tu nombre:</b>
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
}

/** PANEL DE CONTROL */
function listar_categorias()
{
    $categorias = cargar_categorias();
    return $categorias;
}
function cargar_categoria_id($id)
{
    $categorias = array();
    $con = conexion();
    if ($con) {
        $busqueda = mysqli_query($con, "SELECT * from categorias WHERE categoria = '$id'");
        $categorias = mysqli_fetch_assoc($busqueda);
        $con->close();
    }
    return $categorias;
}
function listar_pedidos()
{
    $pedidos = array();
    $con = conexion();
    if ($con) {
        $busqueda = mysqli_query($con, "SELECT * from pedidos ORDER BY fecha DESC");
        while ($pedido = mysqli_fetch_assoc($busqueda)) {
            $pedidos[] = $pedido;
        }
        $con->close();
    }
    return $pedidos;
}
function listar_pedido_id($id)
{
    $pedido = array();
    $con = conexion();
    if ($con) {
        $busqueda = mysqli_query($con, "SELECT * from pedidos WHERE referencia = '$id'");
        $pedido = mysqli_fetch_assoc($busqueda);
        $con->close();
    }
    return $pedido;
}
function listar_productos_idPedido($idPedido)
{
    $productos = array();
    $con = conexion();
    if ($con) {
        $busqueda = mysqli_query($con, "SELECT * from pedido_producto WHERE pedido_id = $idPedido");
        while ($producto = mysqli_fetch_assoc($busqueda)) {
            $productos[] = $producto;
        }
        $con->close();
    }
    return $productos;
}
function obtener_hash($nombreUsuario)
{
    $con = conexion();
    $sql = "SELECT clave from usuarios WHERE nombre = '$nombreUsuario'";
    $resultado = $con->query($sql);
    if ($resultado) {
        $fila = $resultado->fetch_assoc();
        $contrasena = $fila['clave'];
    }
    return $contrasena;
}

?>