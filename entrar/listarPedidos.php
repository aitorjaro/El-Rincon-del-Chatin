<?php
session_start();
require "modelo.php";

if (isset($_SESSION["usuario"])) {

} else {
    header("Location: index.php");
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar productos</title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section>
        <h1 class='h1Anadir'>Lista de pedidos</h1>
    </section>
    <section class="englobarMenu">
        <a class="flechaVolver" href="sesion.php">
            < Volver</a>
            <a class="flechaVolver" href="salir.php">
           <img src="/imagenes/logout.png"/></a>
    </section>
    <section class="cuerpo">
        <form class="dos" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post"
            enctype="multipart/form-data">
            <label>LISTA DE PEDIDOS </label>
            <table>
                    <th>Fecha</th><th>Referencia</th><th>Nombre</th><th>Apellidos</th><th>Teléfono</th>
                
            <?php $pedidos = listar_pedidos();
            foreach ($pedidos as $pedido) { ?>
                <tr><td><?php echo $pedido["fecha"]?></td><td><a class="aPedido" href="mostrarPedido.php?id=<?php echo $pedido['referencia']; ?>"><?php echo $pedido['referencia']; ?></a></td><td><?php echo $pedido["nombre"]?></td><td><?php echo $pedido["apellidos"]?></td><td><?php echo $pedido["telefono"]?></td></tr>
                <?php
            }
            ?>
            </table>
        </form>

    </section>
</body>

</html>