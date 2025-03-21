<?php
//Recoge la información del formulario
	echo $nombre= $_GET["nombrejesuita"]; //asigna el valor que se envía del formulario, recuerda acabar con ;
	echo "<br>";
	echo $codigo= 	$_GET["codigo"]; 
	echo "<br>";
	echo "<br>";

//Conecta con la base de datos ($conexión)
    include 'configdb.php'; //include del archivo con los datos de conexión
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	//Desactiva errores
	$controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;

	//Cadena de caracteres de la consulta sql	
		$sql = "INSERT INTO jesuita (nombre,codigo)VALUES ('" . $nombre . "', '" . $codigo . "')";
		echo $sql; //envía el contenido de la variable al navegador, o sea, muestra la información en el navegador
		
	//Ejecuta la consulta
		$conexion->query($sql);
		if($conexion->affected_rows>0)
			echo "<h2>Registro realizado</h2>";
		else{
			echo "<h2>El registro no se ha realizado</h2>";
			echo '<h3><a href="../Jesuita.html"> Vuelve a intentarlo</a></h3>';
		}	

	//Cierra la conexión
		$conexion->close();
?>
