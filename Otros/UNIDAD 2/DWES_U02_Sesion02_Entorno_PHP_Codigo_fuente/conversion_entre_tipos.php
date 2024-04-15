<?php
    // Conversión automática - ejemplo 1
    $conversionAutomatica1 = 2 + "1";
    echo "Convesión automática 1: $conversionAutomatica1" . "<br>";
    
    // Conversión automática - ejemplo 2
    $booleano = true;
    echo "Booleano - Convesión automática 2: $booleano" . "<br>";
    $conversionAutomatica2 = 2 + $booleano;
    echo "Convesión automática 2: $conversionAutomatica2" . "<br>";
    
    // Conversión automática - ejemplo 3
    $conversionAutomatica3 = 2 + "10.5";
    echo "Convesión automática 3: $conversionAutomatica3" . "<br>";
    
    // Conversión automática - ejemplo 4 (Error: version PHP 8.2)
    $conversionAutomatica4 = 2 + "cadena";
    echo "Convesión automática 4: $conversionAutomatica4" . "<br>";
    
    // Conversión explícita: Casting - ejemplo 1 
    $casting1 = 1.3 + (float) 5;
    echo "Conversión explícita (casting) 1: $casting1" . "<br>"; 
    
    // Conversión explícita: Casting - ejemplo 2 
    $casting2 = (array) 5;
    echo "Conversión explícita (casting) 2: ";
    print_r($casting2); 
?>