<?php
session_start();
define('CON_CONTROLADOR', true);
require "../modelo.php";

if (isset($_SESSION["usuario"])) {

} else {
    header("Location: index.php");
    die();
}
//Método GET
$nombreCategoria = $_GET['id'];
$categoria = cargar_categoria_id($nombreCategoria);

$consulta = "DELETE FROM categorias WHERE categoria='$nombreCategoria'";

$resultado = mysqli_query(conexion(), $consulta);
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoría borrada</title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section>
        <h1 class='h1Anadir'>Categoría borrada</h1>
    </section>
    <section class="englobarMenu">
        <a class="flechaVolver" href="sesion.php">
            < Volver</a>
            <a class="flechaVolver" href="salir.php">
            <img src="/imagenes/logout.png"/></a>
    </section>
    <section class="cuerpo">
        <h2>La categoría ha sido borrada</h2>
    </section>
</body>

</html>