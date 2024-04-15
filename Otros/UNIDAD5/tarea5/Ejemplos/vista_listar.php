<!-- vista_listar.php -->
<!-- MVC: Vista -->
<html>
    <head>
        <title>Ejemplo MVC</title>
    </head>
    <body>
        <h3>Listado de artículos - DWES</h3>
        <ul>
        <!-- Mostramos una lista de los artículos -->
        <?php foreach($articulos as $articulo) { ?>
            <li>
                <a href="controlador_detalle.php?id=<?php echo $articulo['id'] ?>" >
                    <?php echo $articulo['titulo'] ?>
                </a>
            </li>
        <?php } ?>
        </ul>
    </body>
</html>
