<?php session_start();
require "modelo.php";

if(isset($_SESSION["carrito"]) || isset($_POST["idArticulo"])){
    if(isset($_SESSION["carrito"])){
        $carrito_mio=$_SESSION["carrito"];
        if(isset($_POST["idArticulo"])){
            $id_articulo = $_POST["idArticulo"];
            $imagen = $articulo["imagen"];
            $nombre = $articulo["nombre"];
            $precio = $articulo["precio"];
            $cantidad = $_POST["cantidadArticulo"];
            $donde = -1;
        }
    }
}
?>