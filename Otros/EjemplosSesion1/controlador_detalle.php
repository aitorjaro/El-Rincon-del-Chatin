<?php
    //controlador_detalle.php
    // MVC: Controlador
    require_once 'modelo.php';
    if (isset($_GET['id'])) {
        $id_articulo = $_GET['id'];
        $articulo = detalle_articulo($id_articulo);
        require 'vista_detalle.php';
    } else {
        header("HTTP/1.0 404 Not Found");
        echo '<html><body><h1>Página no encontrada</h1></body></html>';
    }
?>

