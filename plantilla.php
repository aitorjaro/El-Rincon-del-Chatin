<?php
session_start();
if (isset($_SESSION["carrito"])) {

    $carrito_mio = $_SESSION["carrito"];
    $total_articulos = 0;

    foreach ($carrito_mio as $total_articulos_articulo) {
        $total_articulos += $total_articulos_articulo["cantidad"];
    }
} else {
    $total_articulos = 0;
}
?>
<?php require_once 'ti.php' ?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php startblock('titulo'); ?>
    <?php endblock() ?>
    <?php startblock('estilo'); ?>
    <?php endblock() ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

</head>

<body>
    <header>

        <nav class="navMenu" id="menuPrincipal">
            <ul>
                <li><a class="menu" href="/index.php">Inicio</a></li>
                <li><a class="menu" href="/sugerencias">Regalos</a></li>
            </ul>
        </nav>
        <h1 class="titulo">EL RINCÓN DEL CHATÍN</h1>
        <!--¡<section class="logoPrincipal">
        <img class="imagenlogoPrincipal" src="/imagenes/logo.png"/>
</section>-->
        <h1 class="tituloOculto">EL RINCÓN DEL CHATÍN</h1>
        <nav class="navMenu">
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

        <!-- Menu desplegable para móviles -->
        <div class="bars__menu">
            <span class="line1__bars-menu"></span>
            <span class="line2__bars-menu"></span>
            <span class="line3__bars-menu"></span>
        </div>
        <script src="/script.js"></script>
    </header>



    <a href="/index.php/cesta"><img class="imagenCarroFija" src="/imagenes/carro-de-la-compra.png" /></a>
    <span class="cantidadCarrito" id="cantidadCarrito"><?php echo $total_articulos ?></span>

    <?php startblock('contenido'); ?>
    <?php endblock() ?>

    <footer>
        <div class="footer">
            <h1 class="tituloFooter">EL RINCÓN DEL CHATÍN</h1>
            <section class="footerFlex">
                <p class="pFooter">C. Braulio Navas, 41, 10700 Hervás (Cáceres).</p>
                <p class="pFooterSans">Horario de atención al cliente:</p>
                <p class="pFooter">Teléfono de contacto: 647 48 16 26</p>
                <p class="pFooter">E-mail: </p>
            </section>
        </div>
    </footer>
</body>

</html>