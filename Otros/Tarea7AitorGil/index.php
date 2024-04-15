<!DOCTYPE html>
<html lang="es">
<?php include 'plantilla.php' ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros y autores</title>
    <style>
        @import url("estilo.css");
    </style>
</head>
<?php startblock('contenido') ?>
<section class="principal">

    <?php
    // Si se ha hecho una peticion que busca informacion de un autor "get_datos_autor" a traves de su "id"...
    if (isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_datos_autor") {
        //Se realiza la peticion a la api que nos devuelve el JSON con la información de los autores
        $app_info = file_get_contents('http://localhost/Tarea7AitorGil/api.php?action=get_datos_autor&id=' . $_GET["id"]);
        // Se decodifica el fichero JSON y se convierte a array
        $app_info = json_decode($app_info);
        ?>
        <section class="englobaDescripcion">
            <img class="autor" src="fotoAutor2.jpeg" width=300px />
            <section class="englobaTexto">

                <h2><?php echo $app_info->datos->nombre . " " . $app_info->datos->apellidos?></h2>

                <p>
                    <td>Nombre: </td>
                    <td>
                        <?php echo $app_info->datos->nombre ?>
                    </td>
                </p>
                <p>
                    <td>Apellidos: </td>
                    <td>
                        <?php echo $app_info->datos->apellidos ?>
                    </td>
                </p>
                <p>
                    <td>Fecha de nacimiento: </td>
                    <td>
                        <?php echo $app_info->datos->nacionalidad ?>
                    </td>
                </p>
                <ul>
                    <h3>Libros del autor:</h3>
                    <!-- Mostramos los libros del autor -->
                    <?php foreach ($app_info->libros as $libros): ?>
                        <li>
                            <!-- Enlazamos cada nombre de autor con su informacion (primer if) -->
                            <a
                                href="<?php echo "http://localhost/Tarea7AitorGil/cliente.php?action=get_datos_libro&id=" . $libros->id ?>">
                                <?php echo $libros->titulo ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        </section>
        <br />
        <!-- Enlace para volver a la lista de autores -->
        <section class="centro">
        <a class="enlaceVolver" href="http://localhost/Tarea7AitorGil/cliente.php?action=get_listado_autores"
            alt="Lista de autores">Volver a
            la lista de autores</a>
                    </section>
        <?php
    } else if (isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_datos_libro") {
        //Se realiza la peticion a la api que nos devuelve el JSON con la información de los libros
        $app_info = file_get_contents('http://localhost/Tarea7AitorGil/api.php?action=get_datos_libro&id=' . $_GET["id"]);
        // Se decodifica el fichero JSON y se convierte a array
        $app_info = json_decode($app_info);
        ?>
        <section class="englobaDescripcion">
            <img class="autor" src="libro.jpeg" width=300px />
            <section class="englobaTexto">
            <h2><?php echo $app_info->titulo ?></h2>
            <p>
                <td>Fecha de publicación: </td>
                <td>
                <?php echo $app_info->fechapublicacion ?>
                </td>
            </p>
            <p>
                <td>Nombre del autor: </td>
                <td>
                <?php echo $app_info->nombre ?>
                </td>
            </p>
            <p>
                <td>Apellidos del autor: </td>
                <td>
                <?php echo $app_info->apellidos ?>
                </td>
            </p>
            <a class="datosAutor" href="http://localhost/Tarea7AitorGil/cliente.php?action=get_datos_autor&id=<?php echo $app_info->idAutor ?>"
                alt="Datos autor">Ver datos del autor</a>
            </section>
        </section>
            <br />
            <!-- Enlace para volver a la lista de libros -->
            <section class="centro">
            <a class="enlaceVolver" href="http://localhost/Tarea7AitorGil/cliente.php?action=get_listado_libros" alt="Lista de libros">Volver a
                la lista de libros</a>
                    </section>
        <?php
    } else //sino muestra la lista de autores
    {
        // Pedimos al la api que nos devuelva una lista de autores. La respuesta se da en formato JSON
        $lista_autores = file_get_contents(dirname(__FILE__) . '/api.php?action=get_listado_autores');
        // Convertimos el fichero JSON en array
        //var_dump($lista_autores);
        $lista_autores = json_decode($lista_autores);
        ?>
            <section class="engloba">
                <img class="autoresYLibros" src="fotoAutor.jpeg" width=300px />
                <section class="autores">
                    <h2>Autores</h2>
                    <ul>

                        <!-- Mostramos una entrada por cada autor -->
                    <?php foreach ($lista_autores as $autores): ?>
                            <li>
                                <!-- Enlazamos cada nombre de autor con su informacion (primer if) -->
                                <a
                                    href="<?php echo "http://localhost/Tarea7AitorGil/cliente.php?action=get_datos_autor&id=" . $autores->id ?>">
                                <?php echo $autores->nombre . " " . $autores->apellidos ?>
                                </a>
                            </li>
                    <?php endforeach; ?>
                    </ul>
                </section>
                <?php
                // Pedimos al la api que nos devuelva una lista de libros. La respuesta se da en formato JSON
                $lista_libros = file_get_contents('http://localhost/Tarea7AitorGil/api.php?action=get_listado_libros');
                // Convertimos el fichero JSON en array
                //var_dump($lista_autores);
                $lista_libros = json_decode($lista_libros);
                ?>

                <section class="libros">

                    <h2>Libros</h2>
                    <ul>

                        <!-- Mostramos una entrada por cada autor -->
                    <?php foreach ($lista_libros as $libros): ?>
                            <li>
                                <!-- Enlazamos cada nombre de autor con su informacion (primer if) -->
                                <a
                                    href="<?php echo "http://localhost/Tarea7AitorGil/cliente.php?action=get_datos_libro&id=" . $libros->id ?>">
                                <?php echo $libros->titulo ?>
                                </a>
                            </li>
                    <?php endforeach; ?>
                    </ul>
                </section>
                <img class="autoresYLibros" src="libro.jpeg" width=300px />

            </section>
        <?php
    } ?>

</section>
<?php endblock() ?>

</html>