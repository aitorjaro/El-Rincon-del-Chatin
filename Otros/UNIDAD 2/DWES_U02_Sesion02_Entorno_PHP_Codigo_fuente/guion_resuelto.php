 <?php
    /* VARIABLES PREDEFINIDAS EN PHP */
 
    // Variable de entorno: Raíz del documento en el que se está ejecutando el script PHP
    echo "Directorio raíz: " . $_SERVER["DOCUMENT_ROOT"] . "<br>";
    // Variable de entorno: Leer el nombre del servidor
    echo "Nombre del servidor: " . $_SERVER["SERVER_NAME"] . "<br>"; 
    
    echo "Tiempo de respuesta: " . $_SERVER["REQUEST_TIME"] . " segundos. </br>";
    
    // Variable del intérprete: Leer una variable llamada nombre desde GET
    // Ejemplo: http://localhost/sesion4/guion_resuelto.php?nombre=dwes
    echo 'Nombre: ' . $_GET["nombre"] . "<br>";
?>


