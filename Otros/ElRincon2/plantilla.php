<?php require_once 'ti.php' ?>
<html>

<head>
    <?php startblock('titulo'); ?>
    <?php endblock() ?>
    <?php startblock('estilo'); ?>
    <?php endblock() ?>
</head>

<body>
    <div class="principal">
        <header>
            <img src="/Tarea5AitorGil/imagenes/banner.jpg" height="600px" width="100%" />
            <nav>
                <ul>
                    <li><a class="menu" href="/Tarea5AitorGil/index.php">INICIO</a></li>
                    <li><a class="menu" href="/Tarea5AitorGil/index.php/sugerencias">SUGERENCIAS</a></li>
                    <li><a class="menu" href="/Tarea5AitorGil/index.php/registro">REGISTRO</a></li>
                </ul>
            </nav>
        </header>
        <?php startblock('contenido'); ?>
        <?php endblock() ?>
    </div>
</body>

</html>