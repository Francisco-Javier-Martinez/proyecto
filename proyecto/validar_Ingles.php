<?php
	$nombre= $_POST["nombrejesuita"]; //asigna el valor que se envía del formulario, recuerda acabar con ;
	$codigo= 	$_POST["codigo"]; 
	
	//Conecta con la base de datos ($conexión)
    include './php/configdb.php'; //include del archivo con los datos de conexión
    $conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
	$conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	
	$sql = "SELECT * FROM jesuita WHERE nombre = '$nombre' AND codigo = '$codigo'";
	$resultado = $conexion->query($sql);
	if ($resultado->num_rows > 0) {
		header("Location: Visita_ingles.php?nombre=" . urlencode($nombre));
	} else {
		echo "<h2>Error: Incorrect name or code</h2>";
		echo '<h3><a href="Jesuita_Ingles.html">Try again</a></h3>';
	}
	
	//Cierra la conexión
	$conexion->close();	
?>