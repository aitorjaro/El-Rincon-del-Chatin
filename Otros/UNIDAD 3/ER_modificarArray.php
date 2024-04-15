<html>
    <head>

    </head>
    <body>
        <?php
            $nuevoArray = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
            print_r($nuevoArray);
            echo "</br> El resultado de multiplicar cada valor de este array por 3 es: </br>";
            foreach ($nuevoArray as $nuevo){
                $nuevo = $nuevo * 3;
                echo $nuevo . "</br>";
            }
        ?>
    </body>
</html>