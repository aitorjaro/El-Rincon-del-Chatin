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
    function cesta() {
        require 'vista_carrito.php';
    }
    function carrito() {
        require 'carrito.php';
    }
    function cestas() {
        $articulos = cargar_cestas();
        require 'vista_cestas.php';
    }

    function contacto(){
        require 'vista_contacto.php';
    }
    function redireccion(){
        require 'vista_redireccion.php';
        crearParametrosPago();
    }
    function tpv_ok(){
        crearPedido();
        require 'vista_tpv_ok.php';
    }
    function busqueda(){
        $articulos = busqueda_articulos($_GET["termino_busqueda"]);
        require 'vista_busqueda.php';
    }

?>
