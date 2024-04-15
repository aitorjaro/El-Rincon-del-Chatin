<?php
    //Controlador frontal
    define('CON_CONTROLADOR', true); //Inicializa la variable CON_CONTROLADOR a true, para que todas las páginas que pasen por index.php tengan esta variable definida.
    require_once 'controladores.php';

    switch ($_SERVER['REQUEST_URI']) {
        case '/':
          // mostrar la página principal
          lista_articulos();
          break;
        case '/index.php':
          // mostrar el formulario de contacto
          lista_articulos();
          break;
        case '/enviar':
          // procesar el formulario de contacto y enviar un correo
          include 'send.php';
          break;
        default:
          // mostrar un error 404
          header("HTTP/1.0 404 Not Found");
        echo '<html><body><h1>Página no encontrada</h1></body></html>';
          break;
      }
?>