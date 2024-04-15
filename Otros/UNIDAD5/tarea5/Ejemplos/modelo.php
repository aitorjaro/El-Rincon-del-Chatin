<?php
    // modelo.php
    // MVC: Modelo
    function cargar_datos() {
        //Carga de los datos (interaccionar con la base de datos para obtener datos)
        $articulos = array(
            0 => array(
                "id" => 0,
                "titulo" => "Altavoz Phoenix"),
            1 => array(
                "id" => 1,
                "titulo" => "Auriculares Urbanista"),
            2 => array(
                "id" => 2,
                "titulo" => "Ratón Logitech")
        );
        return $articulos;
    }

    function lista_articulos() {
        $articulos = cargar_datos();
        return $articulos;
    }

    function detalle_articulo($id) {
        $articulos = cargar_datos();
        return $articulos[$id];
    }
?>
