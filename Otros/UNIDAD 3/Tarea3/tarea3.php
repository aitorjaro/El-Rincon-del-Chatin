<!DOCTYPE html>
<html>
    <head>
        <title>Tarea 3 - Programación básica</title>
        <style>
            @import url("estilotarea3.css");
        </style>
    </head>
    <body>
        <header>
            <h4>Tarea 3 - Programación básica</h4>
        </header>
<?php 

echo "<h1> Primer ejercicio Generar Array </h1>";
echo "<p> Contenido del array: </p>";

      // Primer ejercicio

    function generarArray($valor){
        $lista = array();
        $lista[]=$valor;
        while ($valor-3 >= 0){         // Creamos el bucle para ir almacenando la resta en el array
            $valor = $valor-3;
            $lista[]=$valor;
        }

        return $lista;
    }
    $numero = 15;
    
    foreach(generarArray($numero) as $mostrar){  // Mostramos el contenido del array
        echo $mostrar . ", ";
    }

    // Segundo ejercicio

echo "<h1>Segundo ejercicio Generar Tabla </h1>";
    function tabla($valores){
        echo "<table border='1'>";
        foreach($valores as $valor){
            echo "<tr><td>". $valor . "</td></tr>";
        }
        echo "</table>";
    }

    tabla(generarArray($numero));

?>

<section class="formulario">
		<h1>Tarea 3 - Programación básica</h1>
		</br>
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" >
			<label>Número: </label>
			<input id="valor" type="text" name="valor"></input>
			</br>
			</br>
			<input type="submit"/>
			<?php
				if (isset($_POST["valor"])) { 
					if ($_POST["valor"] == ''){
                        echo "</br></br>Introduzca un valor";
                    }
                    else if (is_numeric($_POST["valor"])) {
                        if ($_POST["valor"]<0){
                            echo "</br></br>Introduzca un valor positivo";
                        }
                        if ($_POST["valor"]>=0 and $_POST["valor"]<=10){
                            echo "</br></br>";
                            tabla(generarArray($_POST["valor"]));
                        }
                        if ($_POST["valor"]>10){
                            echo "</br></br>Número demasiado grande";
                        }
                    }
                    else if (is_numeric($_POST["valor"])==false){
                        echo "</br></br>Introduzca un valor numérico";
                    }
                    else{
                        echo "</br></br>Valor desconocido.";
                    }
            	}
                else {
                    echo "</br></br><h2>No se ha introducido ningún valor</h2>";
                 }
        	?>
			</br>
			</br>
		</form>
		
	</section>
</body>
</html>