<?php
session_start();
require "modelo.php";

if (isset($_SESSION["usuario"])) {

} else {
    header("Location: index.php");
}
//Método GET
$idPedido = $_GET['id'];

$pedido = listar_pedido_id($idPedido);

$productos = listar_productos_idPedido($idPedido)

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Nº <?php echo $idPedido;?></title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section>
        <h1 class='h1Anadir'>Pedido Nº <?php echo $idPedido;?></h1>
    </section>
    <section class="englobarMenu">
        <a class="flechaVolver" href="listarPedidos.php">
            < Volver</a>
            <a class="flechaVolver" href="salir.php">
            <img src="/imagenes/logout.png"/></a>
    </section>
    <section class="cuerpo">
        <form class="dos" enctype="multipart/form-data">
            <label>Fecha </label>
            <p class="pPedidos"><?php echo $pedido["fecha"];?></p>
            <label>Nombre </label>
            <p class="pPedidos"><?php echo $pedido["nombre"];?></p>
            <label>Apellidos</label>
            <p class="pPedidos"><?php echo $pedido["apellidos"];?></p>
            <label>Teléfono </label>
            <p class="pPedidos"><?php echo $pedido["telefono"];?></p>
            <label>Correo electrónico </label>
            <p class="pPedidos"><?php echo $pedido["email"];?></p>
            <label>Dirección </label>
            <p class="pPedidos"><?php echo $pedido["direccion"] . ", " .  $pedido["localidad"] . ", " . $pedido["codigoPostal"];?></p>
            <label>Productos </label>
            <p class="pPedidos"><?php foreach($productos as $producto){
                $productoID = $producto["producto_id"];
                $articulo = cargar_articulo_id($productoID);
                echo $articulo["nombre"] . "(" . $articulo["precio"] . "€)" .  ", ";
                }?></p>
            <label>Total </label>
            <p class="pPedidos"><?php echo $pedido["total"];?></p>
            <label>Total con envío </label>
            <p class="pPedidos"><?php echo $pedido["totalConEnvio"];?></p>
            

        </form>


    </section>
</body>

</html>