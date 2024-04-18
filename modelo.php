<?php
//Modelo

if (!defined('CON_CONTROLADOR')) {
    die("Acceso no permitido. Este archivo no puede ser llamado directamente.");
}
/**
 * Función cargar_datos
 * Carga los artículos en un array
 * @return array $articulos
 */


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
function cargar_articulos()
{
    $articulos = array();
    $con = conexion(); 
    if ($con) {
        $busqueda = mysqli_query($con, "SELECT * from productos");
        while ($articulo = mysqli_fetch_assoc($busqueda)) {
            $articulos[] = $articulo;
        }
        $con->close(); 
    }
    return $articulos;
}
function cargar_articulo_id($id){
    $articulos = array();
    $con = conexion();
    if ($con) {
        $busqueda = mysqli_query($con, "SELECT * from productos WHERE id = $id");
        $articulos = mysqli_fetch_assoc($busqueda);
        $con->close(); 
    }
    return $articulos;
}
function cargar_categorias(){
    $categorias = array();
    $con = conexion(); 
    if ($con) {
        $busqueda = mysqli_query($con, "SELECT * from categorias");
        while ($categoria = mysqli_fetch_assoc($busqueda)) {
            $categorias[] = $categoria;
        }
        $con->close(); 
    }
    return $categorias;
}
/**
 * Función listar_articulos
 * Devuelve el array de artículos cargado
 * @return array $articulos
 */
function listar_articulos()
{
    $articulos = cargar_articulos();
    return $articulos;
}
/**
 * Función detalle_articulos
 * Devuelve el artículo según el ID que le hayamos pasado como parámetro.
 * @param int $id ID del artículo
 * @return $articulos[$id] 
 */
function detalle_articulos($id)
{
    $articulos = cargar_articulo_id($id);
    return $articulos;
}

?>