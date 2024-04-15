<?php

    // Operador de asignación
    $asignación = "operador de asignación";
    echo "Operador de asignación: $asignación" . "<br>";

    // Operador aritmético
    $suma = 7 + 6;
    echo "Operador aritmético: $suma" . "<br>";
    
    // Operador de cadenas
    $DEWS = "Desarrollo " . "Web " . "entorno " . "Servidor";
    echo "Operador de casdenas: $DEWS" . "<br>";
    
    // Operador de incremento/decremento
    echo "Operador de incremento: " . ++$suma . "<br>";

    echo "Operador de decremento: " . --$suma . "</br>";
    
    // Operador de comparación
    $comparación = 3 == 3;
    echo "Operador de comparación: " . $comparación . "<br>";

    // Operador lógico
    $logico = 4 > 3 && 7 > 6;
    echo "Operador lógico: " . $logico . "<br></br>";
    
    // Operador de ejecución
    echo "<b>La ruta del directorio de esta página es: </b></br>" . `dir`;
    
    // Operador de omisión de error
    @$_SERVER['no_existe'];
    
?>
