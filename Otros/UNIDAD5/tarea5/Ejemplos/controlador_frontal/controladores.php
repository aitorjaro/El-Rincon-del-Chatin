<?php
    
    // Controlador Frontal
    /**
     * como controlador frontal
     * /index.php       => (ejecuta index.php) la página que lista los artículos.
     * /index.php/detalle  => (ejecuta index.php) la página que muestra un artículo específico.
     */
    require_once 'index.php';

    // Encamina la petición internamente
    $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    if ($uri == '/UNIDAD5/tarea5/Ejemplos/controlador_frontal/controladores.php') {
        lista_articulos();
    } elseif ($uri == '/UNIDAD5/tarea5/Ejemplos/controlador_frontal/controladores.php/detalle' && isset($_GET['id'])) {
        detalle_articulo($_GET['id']);
    } else {
        header("HTTP/1.0 404 Not Found");
        echo '<html><body><h1>Página no encontrada</h1></body></html>';
    }
?>