<?php
    //Controlador frontal
    define('CON_CONTROLADOR', true); //Inicializa la variable CON_CONTROLADOR a true, para que todas las páginas que pasen por index.php tengan esta variable definida.
    require_once 'controladores.php';

    $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    
    if ($uri == dirname($_SERVER['PHP_SELF']).'/index.php') {
        
        lista_articulos();
    } elseif ($uri == dirname($_SERVER['PHP_SELF']).'/') {
        
        lista_articulos();
    } elseif ($uri == dirname($_SERVER['PHP_SELF']).'/articulo' && isset($_GET['id'])) {
        
        detalle_articulo($_GET['id']);
    } elseif ($uri == dirname($_SERVER['PHP_SELF']).'/sugerencias') {
        
        sugerencias();
    } elseif ($uri == dirname($_SERVER['PHP_SELF']).'/contacto') {
        
        contacto();
    }
    else {
        header("HTTP/1.0 404 Not Found");
        echo '<html><body><h1>Página no encontrada</h1></body></html>';
    }
?>