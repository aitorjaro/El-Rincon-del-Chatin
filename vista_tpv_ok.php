<?php
require_once "modelo.php";
include 'plantilla.php';

if (!isset($_SESSION['pedido_realizado'])) {
    if (!isset($_SESSION['nombre'])) {
        header('Location: /index.php');
    } else {
        $fecha_actual = date('Y-m-d');
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
        $consulta = "INSERT INTO pedidos (fecha, nombre, apellidos, telefono, email, direccion, localidad, codigoPostal, total, totalConEnvio) VALUES ('$fecha_actual', '$nombre', '$apellidos', '$telefono', '$email', '$direccion', '$localidad', '$codigoPostal', '$total', '$totalConEnvio')";

        $resultado = mysqli_query($conexion, $consulta);
        $referencia = mysqli_insert_id($conexion);
        for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {
            $articulo_id = $carrito_mio[$i]['id'];
            $articulo_cantidad = $carrito_mio[$i]["cantidad"];
            $articulo_precio = $carrito_mio[$i]["precio"];
            $consulta2 = "INSERT INTO pedido_producto (pedido_id, producto_id, cantidad, precio) VALUES ('$referencia', '$articulo_id', '$articulo_cantidad', '$articulo_precio')";
            $resultado2 = mysqli_query($conexion, $consulta2);
        }
        $conexion->close();


        // Marcar el pedido como realizado
        $_SESSION['pedido_realizado'] = true;
        $_SESSION['referencia_pedido'] = $referencia;


        //Enviar el mail al dueño y al destinatario del pedido
        $cabeceras = "MIME-Version: 1.0" . "\r\n";
        $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $para = 'aitorjaro11@hotmail.com';
        $asunto = 'Nuevo pedido ' . $referencia;
        $cuerpo = "Tienes un nuevo pedido <b>$referencia</b> de <b>$nombre $apellidos</b>.<br><br><b>Nombre:</b> $nombre<br><b>Apellidos:</b> $apellidos<br><b>Teléfono:</b> $telefono<br><b>Email:</b> $email<br><b>Dirección:</b> $direccion<br><b>Localidad:</b> $localidad<br><b>Código postal:</b> $codigoPostal<br><br>";

        mail($para, $asunto, $cuerpo, $cabeceras);

        //Vaciar el carrito
        unset($_SESSION["carrito"]);
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
            PEDIDO CONFIRMADO CON Nº <?php echo $_SESSION['referencia_pedido']; ?>
        </h1>
    </section>
</section>
<?php endblock() ?>