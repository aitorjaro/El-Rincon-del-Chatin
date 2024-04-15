<?php require_once 'ti.php' ?>
<html>

<head>
    <?php startblock('titulo'); ?>
    <?php endblock() ?>
    <?php startblock('estilo'); ?>
    <?php endblock() ?>
</head>

<body>
    <header>
        
    <nav>
            <ul>
                <li><a class="menu" href="/ElRincon3/index.php">Inicio</a></li>
                <li><a class="menu" href="/sugerencias">Regalos</a></li>
            </ul>
    </nav>


        <h1 class="titulo">EL RINCÓN DEL CHATÍN</h1>

        <nav>
            <ul>
                <li><a class="menu" href="/registro">Hervás</a></li>
                <li><a class="menu" href="/contacto">Contacto</a></li>
                <li>
                    <section class="imagenCarro">
                        <img class="imagenCarrito" src="imagenes/carro.svg" />
                    </section>
                </li>
            </ul>
        </nav>
        

    </header>


    <img class="imagenCarroFija" src="imagenes/carro-de-la-compra.png" />
            <?php startblock('contenido'); ?>
            <?php endblock() ?>
    <footer>
        <div class="footer">
            <p class="footer">Hola</p>
        </div>
    </footer>
</body>
</html>