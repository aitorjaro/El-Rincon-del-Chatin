<?php
    //Controlador

    require_once 'modelo.php';
/**
 * Función lista_articulos
 * Interactua con los artículos que están en "modelo.php" 
 * y los muestra mediante la vista "vista_listar.php".
 */
    function lista_articulos() {
        $articulos = listar_articulos();
        $categorias = cargar_categorias();
        require 'vista_listar.php';
    }
/**
 * Función detalle_articulos
 * Interactua con los artículos que están en "modelo.php" 
 * y muestra el detalle del artículo pasado como parámetro 
 * mediante la vista "vista_detalle.php".
 * @param int $id ID del artículo
 * Se le pasa como parámetro el ID del artículo para saber de qué
 * artículo mostrar el detalle
 */
    function detalle_articulo($id) {
        $articulo = detalle_articulos($id);
        require 'vista_detalle.php';
    }
/**
 * Función sugerencias
 * Muestra la página sugerencias mediante la vista "vista_sugerencias.php"
 */
    function cesta() {
        require 'vista_carrito.php';
    }
    function carrito() {
        require 'carrito.php';
    }
/**
 * Función registro
 * Muestra un registro mediante la vista "vista_registro.php"
 */
    function contacto(){
        require 'vista_contacto.php';
    }
    function tpv_ok(){
        require 'vista_tpv_ok.php';
    }

?>
