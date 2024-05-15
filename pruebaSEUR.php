<?php
$onlyNumbers = 0;
$contenido = "150ml";
$onlyNumbers = $onlyNumbers + (preg_replace('/\D/', '', $contenido));
echo $onlyNumbers;

if ($onlyNumbers < 2000){
    $envio = 5.73;
}
else if ($onlyNumbers >= 2000 ){
    $envio = 6.36;
}
else if ($onlyNumbers >= 3000 ){
    $envio = 6.77;
}
else if ($onlyNumbers >= 4000 ){
    $envio = 7.20;
}



?>