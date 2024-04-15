<?php
    $lista = array("Zack", "Antohny", "Ram", "Salim", "Raghav");
    echo "Los elementos del array son: </br>";
    foreach ($lista as $listamostrada){
        echo $listamostrada . "</br>";
    }

    echo "</br>El número de elementos del array es " . count($lista) . "</br>";

    echo "El array mostrado con el bucle for es: </br>";
    for ($i=0; $i<count($lista);$i++){
        echo "Elemento $i: $lista[$i] </br>";
    }
?>