<?php
//Controlador

require_once 'modelo.php';

$servidor = 'localhost';
$usuario = 'id21731205_aitor';
$contrasena = 'Foc1234*';
$basedatos = 'id21731205_libros';
$libro = new Libros;
$conexion = $libro->conexion($servidor, $basedatos, $usuario, $contrasena);
$autor0 = $libro->consultarAutores($conexion, '0');
$libros0 = $libro->consultarLibros($conexion, '0');
$autor1 = $libro->consultarAutores($conexion, '1');
$libros1 = $libro->consultarLibros($conexion, '1');

$idAutor0 = $autor0 -> id;
$nombreAutor0 = $autor0 -> nombre;
$apellidosAutor0 = $autor0 -> apellidos;
$nacionalidadAutor0 = $autor0 -> nacionalidad;

$idAutor1 = $autor1 -> id;
$nombreAutor1 = $autor1 -> nombre;
$apellidosAutor1 = $autor1 -> apellidos;
$nacionalidadAutor1 = $autor1 -> nacionalidad;
require 'vista_principal.php';

?>