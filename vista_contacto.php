<?php if (!defined("CON_CONTROLADOR")) {
    die("<h2>No se puede llamar a este fichero directamente</h2>");
}
?>
<?php include 'plantilla.php' ?>
<?php startblock('titulo'); ?>
<title>
    Contacto - El Rincón del Chatín (Hervás)
</title>
<?php endblock() ?>
<?php startblock('estilo'); ?>
<style>
    @import url("../estilo.css");
</style>
<?php endblock() ?>
<?php startblock('contenido') ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombreYApellidos'];
    $email = $_POST['email'];
    $numPedido = $_POST['numeroPedido'];
    $mensaje = $_POST['mensaje'];
    $honeypot = $_POST['website']; //Campo oculto para comprobar si los bots lo rellenan automáticamente
    //Comprobamos si el campo oculto está vacío para descartar el spam
    if (isset($_POST['website']) && $_POST['website'] === '') {
        $cabeceras = "MIME-Version: 1.0" . "\r\n";
        $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $para = 'tienda@elrincondelchatin.com';
        $asunto = 'ElRinconDelChatin.com - Nuevo mensaje de ' . $nombre;
        $cuerpo = "Tienes un nuevo mensaje del formulario de contacto de tu página web. <br/><br/><b>Nombre:</b> $nombre<br/><b>Email:</b> $email<br/><b>Nº pedido:</b> $numPedido<br/><br/><b>Mensaje:</b><br/> $mensaje";

        // Usar la función mail() de PHP para enviar el correo
        if (mail($para, $asunto, $cuerpo, $cabeceras)) {
            $mensajeEnviado = "¡Tu mensaje se ha enviado correctamente! Recibirás una respuesta en las próximas horas. Gracias por contactar con nosotros.";
        } else {
            $mensajeEnviado = "Error al enviar el mensaje. Vuélvelo a intentar o contacta con nosotros por otra vía. Lo sentimos :(";
        }
    } else {
        http_response_code(400); // Código de error para descartar el envío
        exit;
    }
}
?>

<section class="englobandoContacto">

    <!-- Mostramos una lista de los artículos -->

    <section class="centrarContacto">

        <h1 class="contacto">
            CONTACTO
        </h1>
        <h2 class="mensajeEnviadoContacto"><?php if (isset($mensajeEnviado))
            echo $mensajeEnviado; ?></h2>
        <section class="englobarContacto">
            <div class="formularioContacto">

                <h2 class="formularioContacto">FORMULARIO DE CONTACTO</h2>
                <form class="formularioContacto" action="" method="post">
                    <div class="divEnglobarDatos">
                        <input name="nombreYApellidos" placeholder="Nombre y Apellidos" required />
                        <input type="mail" name="email" placeholder="Correo electrónico" required />
                    </div>
                    <div class="divEnglobarDatos">
                        <input type="tel" name="telefono" placeholder="Nº de teléfono" required />
                        <input type="number" name="numeroPedido" placeholder="Nº de pedido (opcional)" />
                    </div>
                    <div class="divEnglobarDatos">
                        <textarea class="formularioContacto" name="mensaje" cols="100" rows="20"
                            placeholder="Escribe aquí tu mensaje..." required></textarea>
                    </div>
                    <input type="hidden" name="website" />
                    <div class="divEnglobarDatos">
                        <button type="submit" class="botonPago">Enviar mensaje</button>
                    </div>
                </form>
            </div>
            <div class="formularioContacto">
                <h2 class="formularioContacto">INFORMACIÓN DE CONTACTO</h2>
                <h3 class="h3Contacto">Dirección</h3>
                <p>C. Braulio Navas, 41 </p>
                <p>10700 Hervás (Cáceres).</p>
                <h3 class="h3Contacto">Teléfonos y WhatsApp</h3>
                <a class="aTelefono" href="tel:+34647481626">
                    <p>(+34) 647 48 16 26 </p>
                </a>
                <a class="aTelefono" href="tel:+34647481626">
                    <p>(+34) 627 32 27 73 </p>
                </a>
                <h3 class="h3Contacto">Correo electrónico</h3>
                <a class="aTelefono" href="mailto:tienda@elrincondelchatin.com">
                    <p>tienda@elrincondelchatin.com </p>
                </a>
                <p> </p>
            </div>
        </section>

    </section>

</section>
<?php endblock() ?>