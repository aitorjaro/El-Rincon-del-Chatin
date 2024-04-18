<?php
session_start();
require "modelo.php";

if (isset($_SESSION["usuario"])) {
    $mensaje = "";
} else {
    header("Location: index.php");
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombreCategoria = $_POST["nombre"];


    // Realizar la inserción en la base de datos

    $consulta = "INSERT INTO categorias VALUES ('$nombreCategoria')";

    $resultado = mysqli_query(conexion(), $consulta);

    if ($resultado) {
        $mensaje = "<center>Categoría insertada correctamente.</center></br></br>";
    } else {
        $mensaje = "<center>Error al insertar la categoría: " . mysqli_error($conexion) . "</center></br> </br>";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir categoría</title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section>
        <h1 class='h1Anadir'>Añadir categoría</h1>
    </section>
    <section class="englobarMenu">
        <a class="flechaVolver" href="sesion.php">
            < Volver</a>
    </section>
    <?php echo $mensaje ?>
    <section class="cuerpo">
        <form class="dos" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post"
            enctype="multipart/form-data">
            <label>Nombre de la categoría </label>
            <input name="nombre" type="text" required />

            <input type="submit" class="inptAnadirProductos" value="Añadir categoría" />
        </form>
    </section>
</body>

</html>