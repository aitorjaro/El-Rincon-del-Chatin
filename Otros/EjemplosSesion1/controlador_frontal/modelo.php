<?php
    // modelo.php
    // MVC Controlador Frontal: Modelo
    function cargar_datos() {
        //Carga de los datos (interaccionar con la base de datos para obtener datos)
        $noticias = array(
            0 => array(
                "id" => 0,
                "titulo" => "Conflicto Israel-Palestina"),
            1 => array(
                "id" => 1,
                "titulo" => "Guerra Rusia-Ucrania"),
            2 => array(
                "id" => 2,
                "titulo" => "Pedro Sánchez investido presidente")
        );
        return $noticias;
    }

    function listar_noticias() {
        $noticias = cargar_datos();
        return $noticias;
    }

    function detalle_noticias($id) {
        $noticias = cargar_datos();
        return $noticias[$id];
    }
?>