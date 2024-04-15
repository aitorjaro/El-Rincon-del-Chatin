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
    
            <?php startblock('contenido'); ?>
            <?php endblock() ?>
            
    <footer>
        <div class="footer">
            <p class="footer">Hola</p>
        </div>
    </footer>
</body>
</html>