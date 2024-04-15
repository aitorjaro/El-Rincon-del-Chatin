<?php
    // controladores.php
    // MVC Controlador Frontal: Controlador
    require_once 'modelo.php';

    function lista_noticias() {
        $noticias = listar_noticias();
        require 'vista_listar.php';
    }

    function detalle_noticia($id) {
        $noticia = detalle_noticias($id);
        require 'vista_detalle.php';
    }
?>
