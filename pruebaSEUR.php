<?php
$onlyNumbers = 0;
$contenido = "150ml";
$onlyNumbers = $onlyNumbers + (preg_replace('/\D/', '', $contenido));
echo $onlyNumbers;

if ($onlyNumbers <= 1000){
    $envio = 5.73;
}
else if ($onlyNumbers > 1000 && $onlyNumbers <= 2000 ){
    $envio = 6.36;
}
else if ($onlyNumbers > 2000 && $onlyNumbers <= 3000 ){
    $envio = 6.77;
}
else if ($onlyNumbers > 3000 && $onlyNumbers <= 4000){
    $envio = 7.20;
}
else if ($onlyNumbers > 4000 && $onlyNumbers <= 5000){
    $envio = 7.62;
}
else if ($onlyNumbers > 5000 && $onlyNumbers <= 6000){
    $envio = 8.44;
}
else if ($onlyNumbers > 6000 && $onlyNumbers <= 7000){
    $envio = 9.19;
}
else if ($onlyNumbers > 7000 && $onlyNumbers <= 8000){
    $envio = 10.01;
}
else if ($onlyNumbers > 8000 && $onlyNumbers <= 9000){
    $envio = 10.99;
}
else if ($onlyNumbers > 9000 && $onlyNumbers <= 10000){
    $envio = 12.27;
}
else if ($onlyNumbers > 10000 && $onlyNumbers <= 15000){
    $envio = 15.37;
}
else if ($onlyNumbers > 15000 && $onlyNumbers <= 20000){
    $envio = 19.66;
}
else if ($onlyNumbers > 20000 && $onlyNumbers <= 25000){
    $envio = 25.27;
}
else if ($onlyNumbers > 25000 && $onlyNumbers <= 30000){
    $envio = 30.16;
}
?>