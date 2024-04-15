<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Tarea 6 Aitor Gil - Datos del autor y libros publicados</title>
        <style>
            @import url("estilo.css");
        </style>
</head>
<body>
    <section class="engloba">
    <section class="uno">
    <h1>Datos del autor y libros publicados</h1>
    </section>
    <section class="dos">
<table border="1">
    <tr><th>Id</th> <th>Nombre</th><th>Apellidos</th><th>Nacionalidad</th><th>Libros publicados</th><tr>
        <tr><td><?php echo $idAutor0;?></td><td><?php echo $nombreAutor0;?></td><td><?php echo $apellidosAutor0;?></td><td><?php echo $nacionalidadAutor0;?></td><td><?php $i=0; while (@$libros0[$i]->titulo !=null){echo $libros0[$i]->titulo . ", "; $i++;}?></td></tr>
        <tr><td><?php echo $idAutor1;?></td><td><?php echo $nombreAutor1;?></td><td><?php echo $apellidosAutor1;?></td><td><?php echo $nacionalidadAutor1;?></td><td><?php $i=0; while (@$libros1[$i]->titulo !=null){echo $libros1[$i]->titulo . ", "; $i++;}?></td></tr>
</table>
</section>
</section>
</body>
    </html>