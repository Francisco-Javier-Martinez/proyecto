<?php
		//INICIAR SESION
		session_start();
		
		// Recoge la información del formulario
		echo $idjesuita = $_SESSION["idJesuita"];
		echo $ip = $_GET["ipequipo"];
		echo "<br><br>";

		// Conecta con la base de datos ($conexión)
		include 'configdb.php'; // Include del archivo con los datos de conexión
		$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); // Conecta con la base de datos
		$conexion->set_charset("utf8"); // Usa juego caracteres UTF8

		// Desactiva errores
		$controlador = new mysqli_driver();
		$controlador->report_mode = MYSQLI_REPORT_OFF;

		// Cadena de caracteres de la consulta sql	
		$sql = "INSERT INTO visita (idJesuita, ip) VALUES ('$idjesuita', '$ip')";
		echo $sql; // Enviar el contenido de la variable al navegador

		// Ejecuta la consulta
		$conexion->query($sql);
		if ($conexion->affected_rows > 0) {
			echo "<h2>Visita realizada</h2>";
			echo '<h3><a href="Visita.php">Haz otra visita</a></h3>';
		} else {
			echo "<h2>La visita no se ha realizado</h2>";
			echo '<h3><a href="../Visita.php"> Vuelve a intentarlo</a></h3>';
		}

		// Cierra la conexión
		$conexion->close();
?>
