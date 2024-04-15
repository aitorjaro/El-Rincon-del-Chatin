<?php if (!defined("CON_CONTROLADOR")){
    die("<h2>No se puede llamar a este fichero directamente</h2>");
}
?>
<?php include 'plantilla.php' ?>
<?php startblock('titulo'); ?>
    <title>CYBER MONDAY</title>
<?php endblock() ?>
<?php startblock('estilo'); ?>
    <style>
        @import url("../estilodetalle.css");
    </style>
<?php endblock() ?>
<?php startblock('contenido') ?>
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
<?php endblock() ?>
