<?php
// Conexión a la base de datos y consulta para obtener la imagen
// Asegúrate de incluir el archivo con la función de conexión

$idProducto = $_GET['id']; // Supongamos que recibes el ID del producto como parámetro

$servidor = "localhost";
$bbdd = "productosprueba";
$usuario = "root";
$contrasena = "";
$conexion = new mysqli($servidor, $usuario, $contrasena, $bbdd);
$resultado = mysqli_query($conexion, "SELECT imagen FROM productos WHERE id = $idProducto");
$imgData = $resultado->fetch_assoc();

// Mostrar la imagen
header("Content-type: image/jpeg");
 // Ajusta el tipo de contenido según el tipo de imagen que estés almacenando
echo $imgData['imagen']; 
?>