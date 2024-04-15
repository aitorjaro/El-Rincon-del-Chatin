<!DOCTYPE html>
<html lang="es">
<?php include 'plantilla.php' ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario - Libros y autores</title>
    <style>
        @import url("estilo.css");
    </style>
    <script>

        /**
         * Muestra los libros que coinciden con el valor introducido por el usuario.
         * Esta función usa un objeto XMLHttpRequest para hacer una petición GET al servidor
         * y obtener el listado de libros en formato JSON. Luego, usa una expresión regular
         * para validar el valor del input y mostrar los libros en el elemento con id
         * librosEncontrados.
         * @param String $valor El valor introducido por el usuario en el input.
         * @return void
         */

        function mostrarLibros(valor) {
            // XMLHttpRequest es un objeto JavaScript nativo del navegador que permite hacer solicitudes HTTP desde JavaScript
            var asyncRequest = new XMLHttpRequest();
            // Definimos el controlador de eventos
            asyncRequest.onreadystatechange = cambioEstado;
            // Indicamos el tipo de petición que es: GET
            asyncRequest.open("GET", "servidor_ajax.php?q=" + valor, true);
            // Enviamos la solicitud
            asyncRequest.send();

            /**
             * Controla el estado de la petición XMLHttpRequest y muestra los datos recibidos.
             *
             * Esta función se ejecuta cada vez que cambia el estado de la petición al servidor
             * y comprueba si la respuesta está lista y es correcta. Si es así, obtiene los datos
             * en formato JSON y los muestra en el elemento con id "librosEncontrados".
             *
             * @return void
             */

            function cambioEstado() {
                // Conexión finalizada y respuesta lista => readyState = 4
                // Respuesta correcta => status = 200
                if (asyncRequest.readyState === 4 && asyncRequest.status === 200) {
                    var data = asyncRequest.responseText;
                    document.getElementById("librosEncontrados").innerHTML = data;
                }
            }

            var regex = /^[a-zA-Z]+$/;
            if (regex.test(texto.value)) { // Comprobamos si el valor del input coincide con la expresión regular
                document.getElementById("error").innerHTML = ""; // Si es válido, dejamos vacío el texto
            } else {
                document.getElementById("error").innerHTML = "Introduce solamente caracteres"; // Si no es válido, mostramos el mensaje en el span error
            }
        }
    </script>
</head>
<?php startblock('contenido') ?>
<section class="englobaFormulario">
    <section class="formulario">
        <form>
            <label for="texto">Búsqueda de Libros: </label>
            </br>
            </br>
            <input type="text" id="texto" onkeyup="mostrarLibros(this.value)">
        </form>
        <span id="error"></span>
        <br>
        <!-- En el span con id="librosEncontrados" mostraremos las coincidencias -->
        <p><strong>Libros encontrados:</strong></p>
        <span id="librosEncontrados"></span>
    </section>
</section>
<?php endblock() ?>

</html>