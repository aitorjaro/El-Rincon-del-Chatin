<?php
session_start();

$mensaje = "";

if (isset($_POST["usuario"])) {
    if ($_POST["usuario"] == "foc") {
        if ($_POST["contrasena"] == "Fdwes!22") {
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
    <title>Acceso al sistema</title>
    <style>
        @import url('estilo.css');
    </style>
</head>

<body>
    <section>
        <h1>Acceso al sistema</h1>
    </section>
    <section>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                <article>
                    <label>Usuario: </label>
                </article>
            </br>
            <article>
                <input id="valor" type="text" name="usuario" size="5"></input>
            </article>
    </br>
    </br>
    </br>
        <article>
            <label>Contraseña: </label>
            </article>
            <input id="valor" type="password" name="contrasena" size="7"></input>
    </br>
    </br>
    </br>
    
        <article>
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