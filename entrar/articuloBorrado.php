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
    </section>
    <section class="cuerpo">
    <h2>El producto ha sido borrado</h2>
    </section>
</body>

</html>