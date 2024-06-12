<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

function conexion()
{
    $servidor = "localhost";
    $bbdd = "rinconchatin";
    $usuario = "root";
    $contrasena = "";
    try {
        $conectado = new mysqli($servidor, $usuario, $contrasena, $bbdd);

        if ($conectado->connect_errno) {
            exit("Conexión fallida: " . $conectado->connect_error);
        } else {
            return $conectado;
        }
    } catch (mysqli_sql_exception $excepcion) {
        return null;
    }
}

$articulos = array();
$con = conexion();
if ($con) {
    $categoria = "Aceites";
    $stmt = $con->prepare("SELECT * FROM productos WHERE categoria = ?");
    $stmt->bind_param('s', $categoria);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($articulo = $resultado->fetch_assoc()) {
        // Si la imagen está en formato BLOB, la conviertes directamente a hexadecimal
        $articulo['imagen'] = bin2hex($articulo['imagen']);
        $articulos[] = $articulo;
    }

    $stmt->close();
    $con->close();
}

header('Content-Type: application/json');
echo json_encode($articulos);
?>