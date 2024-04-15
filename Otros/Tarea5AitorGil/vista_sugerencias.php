<?php if (!defined("CON_CONTROLADOR")){
    die("<h2>No se puede llamar a este fichero directamente</h2>");
}
?>
<?php include 'plantilla.php' ?>
<?php startblock('titulo'); ?>
<title>CYBER MONDAY - Sugerencias</title>
<?php endblock() ?>
<?php startblock('estilo'); ?>
<style>
    @import url("../estilo.css");
</style>
<?php endblock() ?>
<?php startblock('contenido') ?>
<h1>SUGERENCIAS</h1>
<section class="sugerencias">
    <form action="sugerencias" method="GET">
        <h2>Deja aquí tu sugerencia</h2>
        </br>
        </br>
        </br>
        <section class="centralformulario">
            <section class="labelinput">
                <label>Nombre</label>
                <input type="text" name="nombre" class="estandar" required></input>
            </section>
            <section class="labelinput">
                <label>Correo electrónico</label>
                <input type="mail" name="correo" class="estandar" required></input>
            </section>

        </section>
        <section class="grupo">
            <section class="mensaje">
                <label>Mensaje</label>
                </br>
                <textarea name="mensaje" rows=20 cols=50 required></textarea>
            </section>
        </section>
        <section class="grupo">
            <input type="submit" class="enviar" />
        </section>
        </br>
        </br>
        <h2>Lista de sugerencias</h2>
        <section class="listasugerencias">

            <?php if (isset($_GET["nombre"])) {
                echo '<section class="agruparsugerencias">
                        <p class="subrayado">Nombre: </p>
                        <p class="mensaje">';

                echo $_GET["nombre"];

                echo "</p> </section>";
            } ?>



            <?php if (isset($_GET["mensaje"])) {
                echo '<section class="agruparsugerencias">
                        <p class="subrayado">Mensaje: </p>
                        <p class"mensaje">';

                echo $_GET["mensaje"];

                echo "</p> </section>";
            } ?>    

        </section>
    </form>
</section>
<?php endblock() ?>