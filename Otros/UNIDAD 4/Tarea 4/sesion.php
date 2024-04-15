<?php
session_start();
//Comprobamos que se ha logeado anteriormente el usuario, y si no, lo devolvemos a la página de login
if (isset($_SESSION["usuario"])) {
    echo "<section> <h1>Bienvenid@ " . $_SESSION["usuario"] . "</h1></section>";
} else {
    header("Location: login.php");
}

//Asociamos los datos introducidos en el formulario a la sesión activa
if (isset($_GET["telefono"])) {
    $_SESSION["telefono"] = $_GET["telefono"];
    $_SESSION["email"] = $_GET["email"];
}
//Generamos las cookies según el horario seleccionado
if (isset($_GET["horario"])) {
    setcookie("horario", $_GET["horario"], time() + 84600, "/");
}
//Vemos si existe la cookies
$cookieExiste = false;
if (isset($_COOKIE["horario"])) {
    $cookieExiste = true;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Bienvenid@
        <?php echo $_SESSION["usuario"] ?>
    </title>
    <style>
        @import url('estilo2.css');
    </style>
</head>

<body>
    <section class="cuerpo">
        <form class="uno" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="GET">
            <section class="formulario">
                <article>
                    <label>Teléfono: </label>
                    <input id="valor" type="number" name="telefono" required value="<?php if (isset($_SESSION["telefono"]))
                        echo $_SESSION["telefono"] ?>" />
                    </article>
                    </br>
                    </br>
                    </br>
                    <article>
                        <label>Email: </label>
                        <input id="valor" type="email" name="email" required value="<?php if (isset($_SESSION["email"]))
                        echo $_SESSION["email"] ?>" />
                    </article>

                    </br>
                    </br>
                    </br>
                    <article class="botones">
                        <input type="submit" value="GRABAR" />
                        <button><a href="cerrarsesion.php">BORRAR</a></button>
                    </article>
                    <article>
                        </br>
                        </br>

                        <?php

                    ?>
                    </br>
                    </br>
            </section>
        </form>

    </section>
    <section class="cuerpo">
        <form class="dos" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="GET">
            <label>Horario: </label>
            <select name="horario">
                <option value="nada"></option>
                <option value="manana" <?php
                if ($cookieExiste == true) {
                    if ($_COOKIE["horario"] == "manana") {
                        echo 'selected="selected"';
                    }
                }
                ?>>Mañana</option>
                <option value="tarde" <?php
                if ($cookieExiste == true) {
                    if ($_COOKIE["horario"] == "tarde") {
                        echo 'selected="selected"';
                    }
                }
                ?>>Tarde</option>
                <option value="noche" <?php
                if ($cookieExiste == true) {
                    if ($_COOKIE["horario"] == "noche") {
                        echo 'selected="selected"';
                    }
                }
                ?>>Noche</option>
            </select>
            <input type="submit" value="GRABAR HORARIO" />
            </br>
            </br>
            <button><a href="borrarcookie.php">BORRAR HORARIO</a></button>

        </form>
    </section>
</body>

</html>