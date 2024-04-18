<?php
session_start();
require "modelo.php";

if (isset($_SESSION["usuario"])) {

} else {
    header("Location: index.php");
}
//Método GET
$idArticulo = $_GET['id'];
$articulo = detalle_articulos($idArticulo);

$consulta = "DELETE FROM productos WHERE id='$idArticulo'";

$resultado = mysqli_query(conexion(), $consulta);
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto borrado</title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section>
        <h1 class='h1Anadir'>Producto borrado</h1>
    </section>
    <section class="englobarMenu">
        <a class="flechaVolver" href="sesion.php">
            < Volver</a>
            <a class="flechaVolver" href="salir.php">
            <img src="/imagenes/logout.png"/></a>
    </section>
    <section class="cuerpo">
        <h2>El producto ha sido borrado</h2>
    </section>
</body>

</html>