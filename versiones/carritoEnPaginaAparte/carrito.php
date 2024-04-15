<?php session_start();
require_once "modelo.php";
if (isset ($_SESSION["carrito"]) || isset ($_POST["idArticulo"])) {
    if (isset ($_SESSION["carrito"])) {
        $carrito_mio = $_SESSION["carrito"];
        if (isset ($_POST["idArticulo"])) {
            $id_articulo = $_POST["idArticulo"];
            $articulo = detalle_articulos($id_articulo);
            $imagen = $articulo["imagen"];
            $nombre = $articulo["nombre"];
            $precio = $articulo["precio"];
            $cantidad = $_POST["cantidadArticulo"];
            $donde = -1;
            if ($donde != -1) {

                $cuanto = $carrito_mio[$donde]["cantidad"] + $cantidad;

                $carrito_mio[$donde] = array(
                    "id" => $id_articulo,
                    "imagen" => $imagen,
                    "nombre" => $nombre,
                    "precio" => $precio,
                    "cantidad" => $cuanto
                );

            } else {

                $carrito_mio[] = array(
                    "id" => $id_articulo,
                    "imagen" => $imagen,
                    "nombre" => $nombre,
                    "precio" => $precio,
                    
                );

            }


        }
    } else {
        $id_articulo = $_POST["idArticulo"];
        $articulo = detalle_articulos($id_articulo);
        $imagen = $articulo["imagen"];
        $nombre = $articulo["nombre"];
        $precio = $articulo["precio"];
        $cantidad = $_POST["cantidadArticulo"];

        $carrito_mio[] = array(
            "id" => $id_articulo,
            "imagen" => $imagen,
            "nombre" => $nombre,
            "precio" => $precio,
            
        );

    }
    $_SESSION["carrito"] = $carrito_mio;
}
echo count($carrito_mio);

?>