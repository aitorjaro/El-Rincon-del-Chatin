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
    Redirección al pago - El Rincón del Chatín (Hervás)
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

        <h1 class="h1carrito">
            ESTÁS SIENDO REDIRIGIDO AL PAGO
        </h1>
        <section class="englobarArticulosCarrito">
            <section class="centrarArticulosCarrito">   
                <p class="carritoVacio">Este proceso puede tardar unos segundos...</p>
            </section>
        </section>
    </section>
</section>
<?php endblock() ?>