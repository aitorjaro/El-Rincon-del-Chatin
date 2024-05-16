<?php
session_start();
define('CON_CONTROLADOR', true);
require "../modelo.php";

if (isset($_SESSION["usuario"])) {
    $mensaje = "";
} else {
    header("Location: index.php");
    die();
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombreProducto = $_POST["nombre"];
    $descripcionProducto = $_POST["descripcion"];
    $precioProducto = $_POST["precio"];
    $contenidoProducto = $_POST["contenido"];
    $categoriaProducto = $_POST["categoria"];
    $conexion = conexion();


    // Recuperar los datos de la imagen

    $tipoArchivo = $_FILES['imagen']['type'];
    $nombreArchivo = $_FILES['imagen']['name'];
    $tamanoArchivo = $_FILES['imagen']['size'];
    $imagenSubida = fopen($_FILES['imagen']['tmp_name'], 'r');
    $binariosImagen = fread($imagenSubida, $tamanoArchivo);
    $binariosImagen = mysqli_escape_string($conexion, $binariosImagen);



    // Realizar la inserción en la base de datos

    $consulta = "INSERT INTO productos (nombre, descripcion, precio, contenido, categoria, imagen) VALUES ('$nombreProducto', '$descripcionProducto', '$precioProducto', '$contenidoProducto', '$categoriaProducto', '$binariosImagen')";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $mensaje = "<center>Producto insertado correctamente.</center></br></br>";
    } else {
        $mensaje = "<center>Error al insertar el producto: " . mysqli_error($conexion) . "</center></br> </br>";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir productos</title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section>
        <h1 class='h1Anadir'>Añadir productos</h1>
    </section>
    <section class="englobarMenu">
        <a class="flechaVolver" href="sesion.php">
            < Volver</a>
            <a class="flechaVolver" href="salir.php">
            <img src="/imagenes/logout.png"/></a>
    </section>
    <?php echo $mensaje ?>
    <section class="cuerpo">
        <form class="dos" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post"
            enctype="multipart/form-data">
            <label>Nombre del producto </label>
            <input name="nombre" type="text" required />
            <label>Descripción </label>
            <textarea name="descripcion" class="txtAreaDescripcion" maxlength="15000" required></textarea>
            <label>Precio (Sin €)</label>
            <input name="precio" class="inptPrecio" type="number" step="any" required />
            <label>Contenido </label>
            <input name="contenido" type="text" placeholder="Ej: 100ml" />
            <label>Categoría </label>
            <select name="categoria">
                <?php
                $conexion = conexion();
                $busqueda = mysqli_query($conexion, "SELECT * FROM categorias");
                while ($categoria = mysqli_fetch_assoc($busqueda)) {
                    echo "<option value='{$categoria['categoria']}'>{$categoria['categoria']}</option>";
                }
                ?>
            </select>
            <label>Imagen </label>
            <input name="imagen" type="file" id="imagen" />
            <input type="submit" class="inptAnadirProductos" value="Añadir producto" />
        </form>
    </section>
</body>

</html>