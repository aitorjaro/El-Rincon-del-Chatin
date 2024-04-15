<?php
// Esta API tiene dos posibilidades; Mostrar una lista de autores o mostrar la información de un autor específico.

//Datos de la aplicación, simulando datos en bd
$obj = new stdClass();
$obj->id="0";
$obj->nombre="J. R. R.";
$obj->apellidos="Tolkien";
$obj->nacionalidad="Inglaterra";
$obj1 = new stdClass();
$obj1->id="1";
$obj1->nombre="Isaac";
$obj1->apellidos="Asimov";	
$obj1->nacionalidad="Rusia";


function get_listado_autores(){

    //Esta información se cargará de la base de datos
	global $obj, $obj1;
	$lista_autores = array($obj, $obj1);
    
    return $lista_autores;
}

function get_datos_autor($id){
	//Esta información se cargará de la base de datos
	global $obj, $obj1;
	$obj_1 = new stdClass();$obj_1->id= 0;$obj_1->titulo="El Hobbit";$obj_1->f_publicacion="21/09/1937";
	$obj_2 = new stdClass();$obj_2->id= 1;$obj_2->titulo="La Comunidad del Anillo";$obj_2->f_publicacion="29/07/1954";
	$obj_3 = new stdClass();$obj_3->id= 2;$obj_3->titulo="Las dos torres";$obj_3->f_publicacion="11/11/1954";
	$obj_4 = new stdClass();$obj_4->id= 3;$obj_4->titulo="El retorno del Rey";$obj_4->f_publicacion="20/10/1955";
	$obj1_1 = new stdClass();$obj1_1->id= 4;$obj1_1->titulo="Un guijarro en el cielo";$obj1_1->f_publicacion="19/01/1950";
	$obj1_2 = new stdClass();$obj1_2->id= 5;$obj1_2->titulo="Fundación";$obj1_2->f_publicacion="01/06/1951";
	$obj1_3 = new stdClass();$obj1_3->id= 6;$obj1_3->titulo="Yo, robot";$obj1_3->f_publicacion="02/12/1950";
	
    $info_autor = new stdClass();
    switch ($id){
        case 0:
          $info_autor->datos = $obj; 
		  $info_autor->libros = array($obj_1, $obj_2, $obj_3, $obj_4); 
          break;
        case 1:
          $info_autor->datos = $obj1; 
		  $info_autor->libros = array($obj1_1, $obj1_2, $obj1_3); 
          break;
    }
    
    return $info_autor;
}

$posibles_URL = array("get_listado_autores", "get_datos_autor");

$valor = "Ha ocurrido un error";

if (isset($_GET["action"]) && in_array($_GET["action"], $posibles_URL))
{
  switch ($_GET["action"])
    {
      case "get_listado_autores":
        $valor = get_listado_autores();
        break;
      case "get_datos_autor":
        if (isset($_GET["id"]))
            $valor = get_datos_autor($_GET["id"]);
        else
            $valor = "Argumento no encontrado";
        break;
    }
}

//devolvemos los datos serializados en JSON
exit(json_encode($valor));
?>
