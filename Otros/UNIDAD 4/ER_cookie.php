<?php
setcookie("nombre", "Aitor Gil", time() + (86400 * 30), "/");
if(isset($_COOKIE["nombre"])){
    echo "La cookie " . $_COOKIE["nombre"] . " esta seteada";
}
else{
    echo "No existe la cookie";
}
?>