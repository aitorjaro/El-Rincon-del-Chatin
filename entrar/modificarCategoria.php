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


// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recibir los datos del formulario
    $nombreCategoria = $_POST["nombre"];
    $conexion = conexion();


    $consulta = "UPDATE categorias SET categoria = '{$nombreCategoria}' WHERE categoria = '{$categoria['categoria']}'";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $mensajeCodificado = urlencode("Categoría modificada correctamente.");
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $nombreCategoria . "&mensaje=" . $mensajeCodificado);
        exit;
    } else {
        $mensajeCodificado = urlencode('"<center>Error al modificar la categoría: " . mysqli_error($conexion) . "</center></br> </br>"');
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $nombreCategoria . "&mensaje=" . $mensajeCodificado);
        exit;
    }

}

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar categoría</title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section>
        <h1 class='h1Anadir'>Modificar categoría</h1>
    </section>
    <section class="englobarMenu">
        <a class="flechaVolver" href="sesion.php">
            < Volver</a>
            <a class="flechaVolver" href="salir.php">
           <img src="/imagenes/logout.png"/></a>
    </section>
    <?php
    if (isset($_GET['mensaje'])) {
        $mensaje = urldecode($_GET['mensaje']);
        echo "<center>$mensaje</center></br></br>";
    } ?>
    <section class="cuerpo">
        <form class="dos" action="<?php echo htmlentities($_SERVER['PHP_SELF']) . '?id=' . $nombreCategoria; ?>"
            method="post" enctype="multipart/form-data">
            <label>Nombre de la categoría </label>
            <input name="nombre" type="text" value="<?php echo $categoria["categoria"] ?>" required />

            <input type="submit" class="inptAnadirProductos" value="Modificar categoría" />
            <a class="aBorrarProductos" href="borrarCategoria.php?id=<?php echo $categoria["categoria"] ?>">Borrar
                Categoría</a>

        </form>


    </section>
</body>

</html>