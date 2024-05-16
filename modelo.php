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


function conexion()
{
    $servidor = "localhost";
    $bbdd = "rinconchatin";
    $usuario = "root";
    $contrasena = "";
    try {
        $conectado = new mysqli($servidor, $usuario, $contrasena, $bbdd);

        if ($conectado->connect_errno) {
            exit("Conexión fallida: " . $conectado->connect_error);
            return null;
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
function cargar_cestas(){
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

/** PANEL DE CONTROL */
function listar_categorias()
{
    $categorias = cargar_categorias();
    return $categorias;
}
function cargar_categoria_id($id){
    $categorias = array();
    $con = conexion(); 
    if ($con) {
        $busqueda = mysqli_query($con, "SELECT * from categorias WHERE categoria = '$id'");
        $categorias = mysqli_fetch_assoc($busqueda);
        $con->close(); 
    }
    return $categorias;
}
function listar_pedidos(){
    $pedidos = array();
    $con = conexion(); 
    if ($con) {
        $busqueda = mysqli_query($con, "SELECT * from pedidos");
        while ($pedido = mysqli_fetch_assoc($busqueda)) {
            $pedidos[] = $pedido;
        }
        $con->close(); 
    }
    return $pedidos;
}
function listar_pedido_id($id){
    $pedido = array();
    $con = conexion(); 
    if ($con) {
        $busqueda = mysqli_query($con, "SELECT * from pedidos WHERE referencia = '$id'");
        $pedido = mysqli_fetch_assoc($busqueda);
        $con->close(); 
    }
    return $pedido;
}
function listar_productos_idPedido($idPedido){
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

?>