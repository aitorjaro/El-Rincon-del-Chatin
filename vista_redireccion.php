<?php include 'plantilla.php';
?>

<?php startblock('titulo'); ?>
<title>
    Redirección al pago - El Rincón del Chatín (Hervás)
</title>
<?php endblock() ?>
<?php startblock('estilo'); ?>
<style>
    @import url("../estilo.css");
</style>
<?php endblock() ?>
<?php startblock('contenido') ?>

<section class="englobandoCarrito">

    <!-- Mostramos una lista de los artículos -->

    <section class="centrarCarrito">

        <h1 class="h1carrito">
            ESTÁS SIENDO REDIRIGIDO AL PAGO
        </h1>
        <section class="englobarArticulosCarrito">
            <section class="centrarArticulosCarrito">   
                <p class="carritoVacio">Este proceso puede tardar unos segundos...</p>
            </section>
        </section>
    </section>
</section>
<?php endblock() ?>