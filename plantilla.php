<?php
ini_set("session.use_only_cookies", "1");
ini_set("session.use_trans_sid", "0");
session_set_cookie_params(0);
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
<html lang="es">

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

        <nav class="navMenu">
            <ul>
            <li>
                    <section class="imagenCarro">
                        <img class="imagenCarrito" id="imagenLupa" src="/imagenes/lupa.svg" />
                    </section>
                </li>
                <li><a class="menu" href="/index.php">Inicio</a></li>
                <li><a class="menu" href="/sugerencias">Regalos</a></li>
                
            </ul>
        </nav>
        <section class="logoPrincipal">
            <img class="imagenlogoPrincipal" src="/imagenes/logo.png" />
        </section>
        <!--<h1 class="titulo">EL RINCÓN DEL CHATÍN</h1>
        
        <h1 class="tituloOculto">EL RINCÓN DEL CHATÍN</h1>-->
        <nav class="navMenu">
            <ul>
                <li><a class="menu" href="/registro">Hervás</a></li>
                <li><a class="menu" href="/index.php/contacto">Contacto</a></li>
                <li>
                    <section class="imagenCarro">
                        <a href="/index.php/cesta"><img class="imagenCarrito" src="/imagenes/carro.svg" /></a>
                    </section>
                </li>
            </ul>
        </nav>

        <!-- Menu desplegable para móviles -->
        <div class="englobaMenuYLupa">
            <div class="bars__menu">
                <span class="line1__bars-menu"></span>
                <span class="line2__bars-menu"></span>
                <span class="line3__bars-menu"></span>
            </div>
            <div class="divLupa">
                <img src="/imagenes/lupa.svg" />
            </div>
        </div>
        <nav class="navMoviles" id="menuPrincipal">
            <ul>
            <img class="imgX" src="/imagenes/x.png" id="imgXMenu"/>
                <li><a class="menu" href="/index.php">Inicio</a></li>
                <li><a class="menu" href="/sugerencias">Regalos</a></li>
                <li><a class="menu" href="/registro">Hervás</a></li>
                <li><a class="menu" href="/index.php/contacto">Contacto</a></li>
                <li>
                    <section class="imagenCarro">
                        <img class="imagenCarrito" src="/imagenes/carro.svg" />
                    </section>
                </li>
            </ul>
        </nav>
        <div class="menuBuscar" id="menuLupa">
            
            <img class="imgX" src="/imagenes/x.png" id="imgXBuscar"/>
            <form action="/index.php/busqueda" method="get">
                <input class="inptBuscar" type="text" name="termino_busqueda" placeholder="Buscar..." />
            </form>
        </div>

        
    </header>
    <script src="/script.js"></script>



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