<?php
session_start();
if (isset ($_SESSION["carrito"])) {

    $carrito_mio = $_SESSION["carrito"];
    $cantidad = count($carrito_mio);
}
else{
    $cantidad = 0;
}
?>
<?php require_once 'ti.php' ?>
<html>

<head>
    <?php startblock('titulo'); ?>
    <?php endblock() ?>
    <?php startblock('estilo'); ?>
    <?php endblock() ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>

<body>
    <header>
        
    <nav>
            <ul>
                <li><a class="menu" href="/index.php">Inicio</a></li>
                <li><a class="menu" href="/sugerencias">Regalos</a></li>
            </ul>
    </nav>
    <h1 class="titulo">EL RINCÓN DEL CHATÍN</h1>
        <!--<section class="logoPrincipal">
        <img class="imagenlogoPrincipal" src="/imagenes/logo.png"/>
</section>-->

        <nav>
            <ul>
                <li><a class="menu" href="/registro">Hervás</a></li>
                <li><a class="menu" href="/index.php/contacto">Contacto</a></li>
                <li>
                    <section class="imagenCarro">
                        <img class="imagenCarrito" src="/imagenes/carro.svg" />
                    </section>
                </li>
            </ul>
        </nav>
        

    </header>


    <a href="/index.php/cesta"><img class="imagenCarroFija" src="/imagenes/carro-de-la-compra.png" /></a>
    <span class="cantidadCarrito" id="cantidadCarrito"><?php echo $cantidad ?></span>
    
    <?php

if (isset ($_SESSION["carrito"])) {

    for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {

        if (isset ($carrito_mio[$i])) {

            if ($carrito_mio[$i] != NULL) {

                if (!isset ($carrito_mio["cantidad"])) {
                    $carrito_mio["cantidad"] = "0";
                } else {
                    $carrito_mio["cantidad"] = $carrito_mio["cantidad"];
                }

                $total_cantidad = $carrito_mio["cantidad"];

                $total_cantidad++;

                if (!isset ($totalcantidad)) {
                    $totalcantidad = "0";
                } else {
                    $totalcantidad = $totalcantidad;
                }

                $totalcantidad += $total_cantidad;

            }
        }
    }

}



//declaramos variables

if (!isset ($totalcantidad)) {
    $totalcantidad = "";
} else {
    $totalcantidad = $totalcantidad;
}

?>
<section class="englobandoCarrito">

<!-- Mostramos una lista de los artículos -->
    <section class="centrarCarrito">

        <h1 class="carrito">
            CARRITO DE LA COMPRA
        </h1>

        <section class="englobarArticulosCarrito">
            <section class="centrarArticulosCarrito">
                <?php if ($cantidad > 0) { ?>
                    <section class="nombreYPrecioCarrito">
                        <p class="articuloYPrecioCarrito">Artículo</p>
                        <p class="articuloYPrecioCarrito">Precio</p>
                    </section>
                    <hr />
                    <section class="articulosVanConAjax">
                    <?php for ($i = 0; $i <= count($carrito_mio) - 2; $i++) { ?>
                        <section class="englobarArticulosDentroCarrito">
                            <section class="englobarImagenArticuloCarrito">
                                <img class="imagenArticuloCarrito"
                                    src="data:image/jpeg;base64,<?php echo base64_encode($carrito_mio[$i]['imagen']); ?>">
                            </section>
                            <p class="nombreArticulosCarrito">
                                <?php echo $carrito_mio[$i]["nombre"]; ?>
                            </p>
                            <p class="nombreArticulosCarrito">
                                <?php
                                echo $carrito_mio[$i]["precio"] . "€";
                                echo "<br/>";
                                ?>
                            </p>
                        </section>
                        <hr />
                    <?php } ?>
                    </section>
                    <p class="totalProductosCarrito">
                        <?php echo "Total de productos: " . $cantidad; ?>
                    </p>
                    <p class="totalPrecioCarrito">Precio total:</p>
                <?php } else { ?>
                    <section class="nombreYPrecioCarrito">
                        <p class="articuloYPrecioCarrito">Artículo</p>
                        <p class="articuloYPrecioCarrito">Precio</p>
                    </section>
                    <hr />
                    <section class="articulosVanConAjax">
                        <section class="englobarArticulosDentroCarrito">
                            <section class="englobarImagenArticuloCarrito">
                                
                            </section>
                            <p class="nombreArticulosCarrito">
                                
                            </p>
                            <p class="nombreArticulosCarrito">
                                <?php
                                
                                echo "<br/>";
                                ?>
                            </p>
                        </section>
                        <hr />
                    
                    </section>
                    <p class="totalProductosCarrito">
                        <?php echo "Total de productos: " . $cantidad; ?>
                    </p>
                    <p class="totalPrecioCarrito">Precio total:</p>
                <?php } ?>
            </section>
        </section>



    </section>

</section>
    
            <?php startblock('contenido'); ?>
            <?php endblock() ?>
            
    <footer>
        <div class="footer">
            <p class="footer">Hola</p>
        </div>
    </footer>
</body>
</html>