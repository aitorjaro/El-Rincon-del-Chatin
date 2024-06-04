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
$idArticulo = $_GET['id'];
$articulo = detalle_articulos($idArticulo);


// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recibir los datos del formulario
    $nombreProducto = $_POST["nombre"];
    $descripcionProducto = $_POST["descripcion"];
    $precioProducto = $_POST["precio"];
    $contenidoProducto = $_POST["contenido"];
    $categoriaProducto = $_POST["categoria"];
    $agotadoProducto = $_POST["agotado"];
    $conexion = conexion();

    if ($agotadoProducto == "No"){
        $agotadoProducto=0;
    }
    else{
        $agotadoProducto=1;
    }

    if (!empty($_FILES['imagen']['name'])) {
        // Recuperar los datos de la imagen

        $tipoArchivo = $_FILES['imagen']['type'];
        $nombreArchivo = $_FILES['imagen']['name'];
        $tamanoArchivo = $_FILES['imagen']['size'];
        $imagenSubida = fopen($_FILES['imagen']['tmp_name'], 'r');
        $binariosImagen = fread($imagenSubida, $tamanoArchivo);
        $binariosImagen = mysqli_escape_string($conexion, $binariosImagen);



        // Realizar la modificación en la base de datos

        $consulta = "UPDATE productos SET nombre = '$nombreProducto', descripcion = '$descripcionProducto', precio = '$precioProducto', contenido = '$contenidoProducto', categoria = '$categoriaProducto', imagen = '$binariosImagen', agotado = '$agotadoProducto' = WHERE id = '$idArticulo'";

        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {
            $mensajeCodificado = urlencode("Producto modificado correctamente.");
            mysqli_close($conexion);
            header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $idArticulo . "&mensaje=" . $mensajeCodificado);
            exit;
        } else {
            $mensajeCodificado = urlencode('"<center>Error al modificar el producto: " . mysqli_error($conexion) . "</center></br> </br>"');
            mysqli_close($conexion);
            header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $idArticulo . "&mensaje=" . $mensajeCodificado);
            exit;
        }

    } else {
        $consulta = "UPDATE productos SET nombre = '$nombreProducto', descripcion = '$descripcionProducto', precio = '$precioProducto', contenido = '$contenidoProducto', categoria = '$categoriaProducto', agotado = '$agotadoProducto' WHERE id = '$idArticulo'";

        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {
            $mensajeCodificado = urlencode("Producto modificado correctamente.");
            mysqli_close($conexion);
            header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $idArticulo . "&mensaje=" . $mensajeCodificado);
            exit;
        } else {
            $mensajeCodificado = urlencode('"<center>Error al modificar el producto: " . mysqli_error($conexion) . "</center></br> </br>"');
            mysqli_close($conexion);
            header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $idArticulo . "&mensaje=" . $mensajeCodificado);
            exit;
        }

    }
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
        <h1 class='h1Anadir'>Modificar productos</h1>
    </section>
    <section class="englobarMenu">
        <a class="flechaVolver" href="listarProductos.php">
            < Volver</a>
                <a class="flechaVolver" href="salir.php">
                    <img src="/imagenes/logout.png" /></a>
    </section>
    <?php
    if (isset($_GET['mensaje'])) {
        $mensaje = urldecode($_GET['mensaje']);
        echo "<center>$mensaje</center></br></br>";
    } ?>
    <section class="cuerpo">
        <form class="dos" action="<?php echo htmlentities($_SERVER['PHP_SELF']) . "?id=" . $idArticulo; ?>"
            method="post" enctype="multipart/form-data">
            <label>Nombre del producto </label>
            <input name="nombre" type="text" value="<?php echo $articulo["nombre"] ?>" required />
            <label>Descripción </label>
            <textarea name="descripcion" class="txtAreaDescripcion" maxlength="15000"
                required><?php echo $articulo["descripcion"] ?></textarea>
            <label>Precio (Sin €)</label>
            <input name="precio" class="inptPrecio" type="number" value="<?php echo $articulo["precio"] ?>" step="any"
                required />
            <label>Contenido </label>
            <input name="contenido" type="text" value="<?php echo $articulo["contenido"] ?>" placeholder="Ej: 100ml" />
            <label>Categoría </label>
            <select name="categoria">
                <?php
                $conexion = conexion();
                $busqueda = mysqli_query($conexion, "SELECT * FROM categorias");
                while ($categoria = mysqli_fetch_assoc($busqueda)) {
                    $selected = ($categoria['categoria'] == $articulo['categoria']) ? 'selected' : '';
                    echo "<option value='{$categoria['categoria']}' $selected>{$categoria['categoria']}</option>";
                }
                mysqli_close($conexion);
                ?>
            </select>
            <label>Imagen </label>
            <input name="imagen" type="file" id="imagen" />
            <label>Producto Agotado </label>
            <select name="agotado">
                <option value="No" <?php echo $articulo["agotado"] == 0 ? 'selected' : ''; ?>>No</option>
                <option value="Si" <?php echo $articulo["agotado"] == 1 ? 'selected' : ''; ?>>Si</option>
            </select>
            <input type="submit" class="inptAnadirProductos" value="Modificar producto" />
            <a class="aBorrarProductos" href="borrarArticulo.php?id=<?php echo $articulo["id"] ?>">Borrar Producto</a>

        </form>


    </section>
</body>

</html>