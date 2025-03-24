<?php
	// Conecta con la base de datos ($conexión)
	include 'php/configdb.php'; // Include del archivo con los datos de conexión
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); // Conecta con la base de datos
	$conexion->set_charset("utf8"); // Usa juego caracteres UTF8
	
	// Desactiva errores
	$controlador = new mysqli_driver();
	$controlador->report_mode = MYSQLI_REPORT_OFF;
	
	// Recoge la información del formulario
    $nomjesu = $_POST["nombrejesuita"];
	//ENCRIPTAR EL CODIGO MEDIANTE HASH
    $codigo = password_hash($_POST["codigo"],PASSWORD_DEFAULT);
    $nomalu = $_POST["nombrealu"];
    $firmae = $_POST["firmaE"];
    $firmai = $_POST["firmaI"];
	
	
	//REALIZAR LA CONSULTA DE INSERCION A JESUITA
	$sql = "INSERT INTO jesuita (codigo, nombre, nombreAlumno, firma, firmaIngles) VALUES ('$codigo', '$nomjesu', '$nomalu', '$firmae', '$firmai');";
	$sql; // Enviar el contenido de la variable al navegador					
	
	// Ejecuta la consulta
	$conexion->query($sql);
	//SI LA FILA ES AFECTADA ES QUE LA COSULTA FUE CORRECTA SI NO ERROR
	if ($conexion->affected_rows > 0) {
		echo "<br>";
		echo "<h2>CONSULTA REALIZADA</h2>";
	} else {
		echo "<h2>La consulta no se ha realizado</h2>";
		echo '<h3><a href="rellenarformulario.html"> Vuelve a intentarlo</a></h3>';
	}


	// Cierra la conexión
	$conexion->close();


?>