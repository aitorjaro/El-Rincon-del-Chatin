<?php
require_once "modelo.php";
include 'plantilla.php';
$fecha_actual = date('Y-m-d');
$nombre = $_SESSION["nombre"];
$apellidos = $_SESSION["apellidos"];
$telefono = $_SESSION["telefono"];
$email = $_SESSION["email"];
$direccion = $_SESSION["direccion"];
$localidad = $_SESSION["localidad"];
$codigoPostal = $_SESSION["codigopostal"];

if (!isset($_SESSION['pedido_realizado'])) {
    $conexion = conexion();
    $consulta = "INSERT INTO pedidos (fecha, nombre, apellidos, telefono, email, direccion, localidad, codigoPostal) VALUES ('$fecha_actual', '$nombre', '$apellidos', '$telefono', '$email', '$direccion', '$localidad', '$codigoPostal')";

    $resultado = mysqli_query($conexion, $consulta);
    $referencia = mysqli_insert_id($conexion);
    $conexion->close();

    // Marcar el pedido como realizado
    $_SESSION['pedido_realizado'] = true;
    $_SESSION['referencia_pedido'] = $referencia;
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