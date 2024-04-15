<!-- vista_listar.php -->
<!-- MVC Controlador Frontal: Vista -->
<html>

<head>
    <title>CYBER MONDAY</title>
    <style>
        @import url("estilo.css");
    </style>
</head>

<body>
    <div class="principal">
        <img src="imagenes/banner.jpg" height="600px" width="100%" />
        <h1>LISTADO DE ARTÍCULOS</h1>
        <section class="articulos">
            <!-- Mostramos una lista de los artículos -->
            <?php foreach ($articulos as $articulo) { ?>
                <section class="articulo">
                    <a href="controladores.php/detalle?id=<?php echo $articulo['id'] ?>">
                        <img height="530px" width="530px" src="<?php echo $articulo['imagen'] ?>" />
                    </a>
                    </br>
                    <a class="titulo" href="controladores.php/detalle?id=<?php echo $articulo['id'] ?>">
                        <?php echo $articulo['titulo'] ?>
                    </a>
                    <h2><?php echo $articulo['precio'] ?>€</h2>
                </section>
            <?php } ?>
        </section>
    </div>
</body>

</html>