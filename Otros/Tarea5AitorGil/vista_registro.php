<?php if (!defined("CON_CONTROLADOR")){
    die("<h2>No se puede llamar a este fichero directamente</h2>");
}
?>
<?php include 'plantilla.php' ?>
<?php startblock('titulo'); ?>
<title>CYBER MONDAY - Registro</title>
<?php endblock() ?>
<?php startblock('estilo'); ?>
<style>
    @import url("../estilo.css");
</style>
<?php endblock() ?>
<?php startblock('contenido') ?>
<h1>REGISTRO</h1>
<section class="sugerencias">
    <form action="registro" method="POST">
        <h2>Regístrate aquí</h2>
        </br>
        </br>
        </br>
        <section class="centralformulario">
            <section class="labelinput">
                <label>Nombre de usuario *</label>
                <input type="text" name="nombreusuario" class="estandar" required></input>
            </section>
            <section class="labelinput">
                <label>Contraseña *</label>
                <input type="password" name="contrasena" class="estandar" required></input>
            </section>
        </section>
        </br>
        </br>
        </br>
        <section class="centralformulario">
            <section class="labelinput">
                <label>Nombre completo</label>
                <input type="text" name="nombrereal" class="estandar"></input>
            </section>
            <section class="labelinput">
                <label>Correo electrónico *</label>
                <input type="mail" name="correo" class="estandar" required></input>
            </section>
            <section class="labelinput">
                <label>Dirección</label>
                <input type="text" name="direccion" class="estandar"></input>
            </section>
        </section>
        </br>
        </br>
        </br>
        <section class="centralformulario">
            <section class="labelinput">
                <label>Código postal</label>
                <input type="number" name="codigopostal" class="estandar"></input>
            </section>
            <section class="labelinput">
                <label>Ciudad</label>
                <input type="text" name="ciudad" class="estandar"></input>
            </section>
        </section>
        <section class="grupo">

        </section>
        </br>
        </br>
        <section class="grupo">
            <input type="submit" class="enviar" value="Registrarme" />
        </section>
        </br>
        </br>

        <?php if (isset($_POST["nombreusuario"])) {
            echo '<p class="registrado">¡Enhorabuena, te has registrado correctamente!';
            echo "</p>";
        } ?>
    </form>
</section>
<?php endblock() ?>