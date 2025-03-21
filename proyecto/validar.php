<?php
	$nombre= $_POST["nombrejesuita"]; //asigna el valor que se envía del formulario, recuerda acabar con ;
	$codigo= $_POST["codigo"]; 
	
	//Conecta con la base de datos ($conexión)
    include './php/configdb.php'; //include del archivo con los datos de conexión
    $conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
	$conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	// Desactiva errores
	$controlador = new mysqli_driver();
	$controlador->report_mode = MYSQLI_REPORT_OFF;
	
	//VER SI EXISTE NOMBRE Y CODIGO
	$sql = "SELECT * FROM jesuita WHERE nombre = '$nombre' AND codigo = '$codigo'";
	$resultado = $conexion->query($sql);
	if ($resultado->num_rows > 0) {
		session_start();
		$fila=$resultado->fetch_array();
		$_SESSION["idJesuita"]=$fila["idJesuita"];
		$_SESSION["nombre"]=$fila["nombre"];
		echo "<h2>Buenas, $nombre ves a realizar tu visita: </h2>";
		echo '<h3><a href="Visita.php">Ir a visitar</a></h3>';
	} else {
		echo "<h2>Error: Nombre o código incorrectos</h2>";
		echo '<h3><a href="Jesuita.html">Volver a intentarlo</a></h3>';
	}
	
	//Cierra la conexión
	$conexion->close();	
?>