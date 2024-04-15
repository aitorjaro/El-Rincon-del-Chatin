<!-- vista_detalle.php -->
<!-- MVC Controlador Frontal: Vista -->
<html>

<head>
    <title>CYBER MONDAY</title>
    <style>
        @import url("../estilodetalle.css");
    </style>
</head>

<body>
    <div class="principal">
        <img src="../imagenes/banner.jpg" height="600px" width="100%" />
        <h1>
            <?php echo $articulo['titulo'] ?>
        </h1>
        <section class="articulos">

            <!-- Mostramos una lista de los artículos -->

            <section class="articulo">

                <img src="../<?php echo $articulo['imagen'] ?>" width=600px; height=600px; />

                <h2>
                    <?php echo $articulo['precio'] ?>€
                </h2>
                <section class="descripcion">
                    <h2>Descripción
                    </h2>
                    <?php echo $articulo['descripcion'] ?>
                    </br>
                    
                    <h2>Características
                    </h2>
                    <?php echo $articulo['caracteristicas'] ?>
                </section>
                </section>
                
            </section>

        </section>
    </div>
</body>

</html>