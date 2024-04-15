<!-- vista_listar.php -->
<!-- MVC Controlador Frontal: Vista -->
<html>
    <head>
        <title>Ejemplo MVC</title>
    </head>
    <body>
        <h3>Listado de noticias - DWES</h3>
        <ul>
        <!-- Mostramos una lista de los artículos -->
        <?php foreach($noticias as $noticia) { ?>
            <li>
                <a href="index.php/detalle?id=<?php echo $noticia['id'] ?>" >
                    <?php echo $noticia['titulo'] ?>
                </a>
            </li>
        <?php } ?>
        </ul>
    </body>
</html>
