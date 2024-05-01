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
        $busqueda = mysqli_query($con, "SELECT * from productos");
        while ($articulo = mysqli_fetch_assoc($busqueda)) {
            $articulos[] = $articulo;
        }
        $con->close(); 
    }
    return $articulos;
}
function cargar_articulo_id($id){
    $articulos = array();
    $con = conexion();
    if ($con) {
        $busqueda = mysqli_query($con, "SELECT * from productos WHERE id = $id");
        $articulos = mysqli_fetch_assoc($busqueda);
        $con->close(); 
    }
    return $articulos;
}
function cargar_categorias(){
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
function insertar_pedido(){
    
}
function busqueda_articulos($termino){
    $articulos = array();
    $con = conexion(); 
    $termino = $con->real_escape_string($termino);
    $query = "SELECT * FROM productos WHERE nombre LIKE '%$termino%'";
    $resultado = $con->query($query);
    if ($resultado->num_rows > 0) {
        while($articulo = $resultado->fetch_assoc()) {
          $articulos[] = $articulo;
        }
      } 
      $con->close();
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

function crearParametrosPago(){
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
        $url="https://www.elrincondelchatin.com/";
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
}

?>