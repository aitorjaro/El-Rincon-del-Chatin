<?php

$contrasena = '003976'; 
$opciones = [
    'cost' => 12, 
];
$hash = password_hash($contrasena, PASSWORD_BCRYPT, $opciones);

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
            return null;
        } else {
            return $conectado;
        }
    } catch (mysqli_sql_exception $excepcion) {
        return null;
    }
}

$sql = "INSERT INTO usuarios (nombre, clave) VALUES ('rinconchatin', '$hash')";

$conexion = conexion();
// Ejecutar la consulta
if ($conexion->query($sql) === TRUE) {
    echo "Nuevo registro creado con éxito";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

// Cerrar conexión
$conexion->close();
?>