<?php session_start();
if (isset ($_SESSION["carrito"]) || isset ($_POST["idArticulo"])) {
    if (isset ($_SESSION["carrito"])) {
        $carrito_mio = $_SESSION["carrito"];
        if (isset ($_POST["idArticulo"])) {
            $id_articulo = $_POST["idArticulo"];
            $cantidad = $_POST["cantidadArticulo"];
            $donde = -1;
            if ($donde != -1) {

                $cuanto = $carrito_mio[$donde]["cantidad"] + $cantidad;

                $carrito_mio[$donde] = array(
                    "id" => $id_articulo,
                    "cantidad" => $cuanto
                );

            } else {

                $carrito_mio[] = array(
                    
                );

            }


        }
    } else {
        $id_articulo = $_POST["idArticulo"];
        
        $cantidad = $_POST["cantidadArticulo"];

        $carrito_mio[] = array(

            
        );

    }
    
    echo count($carrito_mio);
}