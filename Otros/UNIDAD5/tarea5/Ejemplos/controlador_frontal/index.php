<?php
    //Controlador
    require_once 'modelo.php';

    function lista_articulos() {
        $articulos = listar_articulos();
        require 'vista_listar.php';
    }

    function detalle_articulo($id) {
        $articulo = detalle_articulos($id);
        require 'vista_detalle.php';
    }
?>
