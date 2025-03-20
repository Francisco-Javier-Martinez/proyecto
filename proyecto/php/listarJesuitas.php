<?php
//Recoge la información del formulario
	$nombre= $_GET["nombrejesuita"]; //asigna el valor que se envía del formulario, recuerda acabar con ;
	$codigo= $_GET["codigo"]; 
	
//Conecta con la base de datos ($conexión)
    include 'configdb.php'; //include del archivo con los datos de conexión
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	//Desactiva errores
	$controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;
	
//Cadena de caracteres de la consulta sql	
	$sql="SELECT nombre,firma FROM jesuita WHERE codigo='$codigo' AND nombre='$nombre'";
	/*$sql="SELECT nombre,firma FROM jesuita;*/
	echo $sql;	//Para probar
	$resultado=$conexion->query($sql);	//Ejecuta la consulta sql
	echo "<h1>LISTADO DE JESUITAS</h1>";
	//Extrae cada una de las filas del resultado de la consulta
	while($fila=$resultado->fetch_array()){
		echo "<p>".$fila["nombre"]."     ".$fila["firma"]."</p>";
	}
	
//Cierra la conexión
	$conexion->close();
?>