<?php
		//INICIAR SESION
		session_start();
		
		// Recoge la información del formulario
		 $idjesuita = $_SESSION["idJesuita"];
		 $ip = $_GET["ipequipo"];
		 "<br><br>";

		// Conecta con la base de datos ($conexión)
		include 'configdb.php'; // Include del archivo con los datos de conexión
		$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); // Conecta con la base de datos
		$conexion->set_charset("utf8"); // Usa juego caracteres UTF8

		// Desactiva errores
		$controlador = new mysqli_driver();
		$controlador->report_mode = MYSQLI_REPORT_OFF;

		// Cadena de caracteres de la consulta sql	
		$sql = "INSERT INTO visita (idJesuita, ip) VALUES ('$idjesuita', '$ip')";
		$sql; // Enviar el contenido de la variable al navegador
?>
<!--HTML PARA PONER ESTILOS-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Validación</title>
		<link rel="stylesheet" href="../css/camino.css">
	</head>
	<body>
		<div class="vali">
			<?php
					// Ejecuta la consulta
					$conexion->query($sql);
					if ($conexion->affected_rows > 0) {
						echo "<h2>Visita realizada</h2>";
						echo '<h3><a href="../Visita.php">Haz otra visita</a></h3>';
					} else {
						echo "<h2>La visita no se ha realizado</h2>";
						echo '<h3><a href="../Visita.php"> Vuelve a intentarlo</a></h3>';
					}
			?>
		</div>
	</body>
</html>
<?php
		// Cierra la conexión
		$conexion->close();
?>
