<?php
session_start();
require "modelo.php";

if (isset($_SESSION["usuario"])) {
    echo "<section> <h1>Añadir productos</h1></section>";
} else {
    header("Location: index.php");
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombreProducto = $_POST["nombre"];
    $descripcionProducto = $_POST["descripcion"];
    $precioProducto = $_POST["precio"];
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

    $consulta = "INSERT INTO productos (nombre, descripcion, precio, categoria, imagen) VALUES ('$nombreProducto', '$descripcionProducto', '$precioProducto', '$categoriaProducto', '$binariosImagen')";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "Producto insertado correctamente.";
    }
    else {
        echo "Error al insertar el producto: " . mysqli_error($conexion);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Añadir productos</title>
    <style>
        @import url('estilo2.css');
    </style>
</head>
<body>
    <section class="cuerpo">
        <form class="dos" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <label>Nombre del producto: </label>
            <input name="nombre" type="text" required />
            <label>Descripción: </label>
            <input name="descripcion" type="text" required />
            <label>Precio: </label>
            <input name="precio" type="number" step="any" required />
            <label>Categoría: </label>
            <select name="categoria">
                <?php
                $conexion = conexion();
                $busqueda = mysqli_query($conexion, "SELECT * FROM categorias");
                while ($categoria = mysqli_fetch_assoc($busqueda)){
                    echo "<option value='{$categoria['categoria']}'>{$categoria['categoria']}</option>";
                }
                ?>
            </select>
            <label>Imagen: </label>
            <input name="imagen" type="file" id="imagen" />
            <input type="submit" value="Añadir producto" />
        </form>
    </section>
</body>
</html>
