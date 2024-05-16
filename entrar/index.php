<?php
session_start();
define('CON_CONTROLADOR', true);
require "../modelo.php";

$mensaje = "";

$contrasena_hasheada = obtener_hash("rinconchatin");

if (isset($_POST["usuario"])) {
    if ($_POST["usuario"] == "rinconchatin") {
        $contrasena_ingresada = $_POST["contrasena"];
        if (password_verify($contrasena_ingresada, $contrasena_hasheada)) {
            $_SESSION["usuario"] = $_POST["usuario"];
            header("Location: sesion.php");
        } else {
            $mensaje = "</br></br></br>Credenciales incorrectas.";
        }
    } else {
        $mensaje = "</br></br></br>Credenciales incorrectas.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section class="sectionTituloAcceso">
        <h1 class="h1Acceso">Panel de control</h1>
    </section>
    <section>
        <form class="formularioEntrada" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <article class="articleLogin">
                <label>Usuario: </label>
            </article>
            </br>
            <article class="articleLogin">
                <input id="valor" type="text" name="usuario" size="5"></input>
            </article>
            </br>
            </br>
            </br>
            <article class="articleLogin">
                <label>Contraseña: </label>
            </article class="articleLogin">
            <input id="valor" type="password" name="contrasena" size="7"></input>
            </br>
            </br>
            </br>

            <article class="articleLogin">
                <input type="submit" value="ENTRAR" />
            </article>
            <?php
            echo $mensaje;
            ?>
            </br>
            </br>
        </form>
    </section>
</body>

</html>