<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Probando el servidor php</title>
    </head>
    <body>
        Contenido de la página web con PHP <br>
        <!-- Directiva 'short_open_tag' -->
        <?php echo "Sintaxis clásica" . "<br>" ?>
        <? echo "Sintaxis abreviada" . "<br>" ?>
        <br>
        <?php
            // Directiva 'precision'
            $decimal = 7.234455667772;
            echo "Valor decimal con precisión: $decimal" . "<br>";
            
            // Directiva 'display_errors'
            // $8incorrecto = 8;
        ?>
    </body>
</html>
