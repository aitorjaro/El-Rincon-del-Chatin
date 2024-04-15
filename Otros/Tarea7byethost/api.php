<?php
require("Libros.php");
// Esta API tiene dos posibilidades; Mostrar una lista de autores o mostrar la información de un autor específico.

//Datos de la aplicación, simulando datos en bd
/*$obj = new stdClass();
$obj->id="0";
$obj->nombre="J. R. R.";
$obj->apellidos="Tolkien";
$obj->nacionalidad="Inglaterra";
$obj1 = new stdClass();
$obj1->id="1";
$obj1->nombre="Isaac";
$obj1->apellidos="Asimov";	
$obj1->nacionalidad="Rusia";
*/

$servidor = 'localhost';
$usuario = 'b7_35793598';
$contrasena = '72y031s5';
$basedatos = 'b7_35793598_libros';

/**
 * Obtiene el listado completo de autores de la base de datos
 * @return mysqli objeto mysqli con la lista de autores
 */
function get_listado_autores()
{

  //Esta información se cargará de la base de datos
  /*global $obj, $obj1;
   $lista_autores = array($obj, $obj1);
   */

  global $servidor, $usuario, $contrasena, $basedatos;
  $libros = new Libros();
  $conectar = $libros->conexion($servidor, $basedatos, $usuario, $contrasena);
  $lista_autores = $libros->consultarAutores($conectar, null);

  return $lista_autores;
}

/**
 * Obtiene los datos del autor
 * @param int $id ID del autor a consultar
 * @return stdClass objeto con los datos del autor y sus libros
 */

function get_datos_autor($id)
{
  //Esta información se cargará de la base de datos
  /*global $obj, $obj1;
   $obj_1 = new stdClass();$obj_1->id= 0;$obj_1->titulo="El Hobbit";$obj_1->f_publicacion="21/09/1937";
   $obj_2 = new stdClass();$obj_2->id= 1;$obj_2->titulo="La Comunidad del Anillo";$obj_2->f_publicacion="29/07/1954";
   $obj_3 = new stdClass();$obj_3->id= 2;$obj_3->titulo="Las dos torres";$obj_3->f_publicacion="11/11/1954";
   $obj_4 = new stdClass();$obj_4->id= 3;$obj_4->titulo="El retorno del Rey";$obj_4->f_publicacion="20/10/1955";
   $obj1_1 = new stdClass();$obj1_1->id= 4;$obj1_1->titulo="Un guijarro en el cielo";$obj1_1->f_publicacion="19/01/1950";
   $obj1_2 = new stdClass();$obj1_2->id= 5;$obj1_2->titulo="Fundación";$obj1_2->f_publicacion="01/06/1951";
   $obj1_3 = new stdClass();$obj1_3->id= 6;$obj1_3->titulo="Yo, robot";$obj1_3->f_publicacion="02/12/1950";
   */
  global $servidor, $usuario, $contrasena, $basedatos;
  $libros = new Libros();
  $conectar = $libros->conexion($servidor, $basedatos, $usuario, $contrasena);
  $datos_autor = $libros->consultarAutores($conectar, $id);
  $libros_autor = $libros->consultarLibros($conectar, $id);

  $info_autor = new stdClass();
  switch ($id) {
    case 0:
      $info_autor->datos = $datos_autor;
      $info_autor->libros = $libros_autor;
      break;
    case 1:
      $info_autor->datos = $datos_autor;
      $info_autor->libros = $libros_autor;
      break;
  }

  return $info_autor;
}

/**
 * Obtiene el listado completo de los libros de la base de datos
 * @return array array con la lista de libros
 */
function get_listado_libros()
{

  global $servidor, $usuario, $contrasena, $basedatos;
  $libros = new Libros();
  $conectar = $libros->conexion($servidor, $basedatos, $usuario, $contrasena);
  $lista_libros = $libros->consultarLibros($conectar, null);

  return $lista_libros;
}

/**
 * Obtiene los datos del libro
 * @param string $id ID del libro a consultar
 * @return stdClass objeto con los datos del libro
 */
function get_datos_libro($id)
{

  global $servidor, $usuario, $contrasena, $basedatos;
  $libros = new Libros();
  $conectar = $libros->conexion($servidor, $basedatos, $usuario, $contrasena);
  $datos_libro = $libros->consultarDatosLibro($conectar, $id);
  $titulo = $datos_libro->titulo;
  $fecha_publicacion = $datos_libro->f_publicacion;

  $id_autor = $datos_libro->id_autor;
  $datos_autor = $libros->consultarAutores($conectar, $id_autor);
  $nombre_autor = $datos_autor->nombre;
  $apellidos_autor = $datos_autor->apellidos;


  $info_libros = new stdClass();

  $info_libros->titulo = $titulo;
  $info_libros->fechapublicacion = $fecha_publicacion;
  $info_libros->nombre = $nombre_autor;
  $info_libros->apellidos = $apellidos_autor;
  $info_libros->idAutor = $id_autor;


  return $info_libros;
}

$posibles_URL = array("get_listado_autores", "get_datos_autor", "get_listado_libros", "get_datos_libro");

$valor = "Ha ocurrido un error";

if (isset($_GET["action"]) && in_array($_GET["action"], $posibles_URL)) {
  switch ($_GET["action"]) {
    case "get_listado_autores":
      $valor = get_listado_autores();
      break;
    case "get_datos_autor":
      if (isset($_GET["id"]))
        $valor = get_datos_autor($_GET["id"]);
      else
        $valor = "Argumento no encontrado";
      break;
    case "get_listado_libros":
      $valor = get_listado_libros();
      break;
      case "get_datos_libro":
        $valor = get_datos_libro($_GET["id"]);
        break;
  }
}

//devolvemos los datos serializados en JSON
exit(json_encode($valor));
?>