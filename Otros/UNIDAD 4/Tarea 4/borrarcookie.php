<?php
setcookie("horario","",time()-3600,"/");
header("Location: sesion.php");
?>