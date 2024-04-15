<?php

$lista_libros = file_get_contents('http://localhost/Tarea8AitorGilSinLaravel/api.php?action=get_listado_libros');
$lista_libros = json_decode($lista_libros);

// Obtenemos el parámetro GET de la URL
$q = $_REQUEST["q"];
        
// Variable que contendrá los libros
$libros = "";

if ($q !== ""){
    // Devuelve un string con todos los caracteres alfabéticos convertidos a minúsculas.
    $q = strtolower($q);
    // Obtiene la longitud de un string
    $len = strlen($q);
    
    // Se buscan coincidencias sobre los datos la base de datos ($libro)
    foreach ($lista_libros as $libro) {
        // Devuelve toda la cadena desde la primera aparición del caracter
        if (stristr($q, substr($libro->titulo, 0, $len))){
            $libros .=  $libro->titulo . "<br>" ;
        }
    }
    echo $libros === "" ? "No se encuentran libros con ese nombre" : $libros;
}

?>
