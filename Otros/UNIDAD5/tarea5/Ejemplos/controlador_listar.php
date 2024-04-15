<?php
    // controlador_listar.php
    // MVC: Controlador
    require_once 'modelo.php';
    $articulos = lista_articulos();
    require 'vista_listar.php';
?>
