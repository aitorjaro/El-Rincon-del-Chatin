<?php session_start();
require_once "modelo.php";
$carrito_mio = isset($_SESSION["carrito"]) ? $_SESSION["carrito"] : array();
if (isset($_SESSION["carrito"]) || isset($_POST["idArticulo"])) {
    if (isset($_SESSION["carrito"])) {
        $carrito_mio = $_SESSION["carrito"];
    }

    // Añadir o actualizar un artículo
    if (isset($_POST["idArticulo"])) {
        $id_articulo = $_POST["idArticulo"];
        $articulo = detalle_articulos($id_articulo);
        $imagen = $articulo["imagen"];
        $nombre = $articulo["nombre"];
        $precio = $articulo["precio"];
        $cantidad = $_POST["cantidadArticulo"];

        // Buscar el artículo en el carrito
        $donde = array_search($id_articulo, array_column($carrito_mio, 'id'));

        if ($donde !== false) {
            // Actualizar cantidad si el artículo ya existe
            $carrito_mio[$donde]["cantidad"] += $cantidad;
        } else {
            // Añadir nuevo artículo
            $carrito_mio[] = array(
                "id" => $id_articulo,
                "imagen" => $imagen,
                "nombre" => $nombre,
                "precio" => $precio,
                "cantidad" => $cantidad
            );
        }
    }

    // Actualizar cantidad de un artículo existente
    if (isset($_POST["actualizar"]) && isset($_POST["id"]) && isset($_POST["cantidad"])) {
        $id = $_POST["id"];
        $cantidad = $_POST["cantidad"];

        // Buscar el artículo en el carrito
        $donde = array_search($id, array_column($carrito_mio, 'id'));

        if ($donde !== false) {
            if ($cantidad < 1) {
                // Eliminar el artículo si la cantidad es menor que 1
                unset($carrito_mio[$donde]);
                header("Location: ".$_SERVER["HTTP_REFERER"]."");
            } else {
                // Actualizar la cantidad
                $carrito_mio[$donde]["cantidad"] = $cantidad;
                header("Location: ".$_SERVER["HTTP_REFERER"]."");
            }
        }
    }

    // Borrar un artículo
    if (isset($_POST["borrar"]) && isset($_POST["id2"])) {
        $id = $_POST["id2"];

        // Buscar el artículo en el carrito
        $donde = array_search($id, array_column($carrito_mio, 'id'));
        header("Location: ".$_SERVER["HTTP_REFERER"]."");

        if ($donde !== false) {
            // Eliminar el artículo
            unset($carrito_mio[$donde]);
            header("Location: ".$_SERVER["HTTP_REFERER"]."");
        }
    }

    // Reindexar el array después de borrar para evitar problemas con índices faltantes
    $carrito_mio = array_values($carrito_mio);

    $_SESSION["carrito"] = $carrito_mio;
}
//Mostrar la cantidad total de los artículos teniendo en cuenta que haya repetidos
$total_articulos = 0;

foreach ($carrito_mio as $total_articulos_articulo) {
    $total_articulos += $total_articulos_articulo["cantidad"];
}

echo $total_articulos;


?>

