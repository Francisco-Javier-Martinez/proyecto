<?php
	$nombre= $_POST["nombrejesuita"]; //asigna el valor que se envía del formulario, recuerda acabar con ;
	$codigo1= $_POST["codigo"]; //Pongo 1 ya que codigo existe;
	
	//Conecta con la base de datos ($conexión)
    include './php/configdb.php'; //include del archivo con los datos de conexión
    $conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
	$conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	// Desactiva errores
	$controlador = new mysqli_driver();
	$controlador->report_mode = MYSQLI_REPORT_OFF;
	
	//CONSULTA PARA VERIFICAR QUE EL NOMBRE EXISTA
	$sql = "SELECT idJesuita,nombre, codigo FROM jesuita WHERE nombre = '$nombre'";
	$resultado = $conexion->query($sql);
?>
<!--HTML PARA PONER ESTILOS-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Validación</title>
		<link rel="stylesheet" href="css/camino.css">
	</head>
	<body>
		<div class="vali">
			<?php
			//VER SI EXISTE NOMBRE Y CODIGO
			if ($resultado->num_rows > 0) {
				$fila=$resultado->fetch_array();
				//VERIFICAR QUE LA CONTRASEÑA SEA CORRECTA
			 if (password_verify($codigo1, $fila["codigo"])) {  
					session_start();
					$_SESSION["idJesuita"]=$fila["idJesuita"];
					$_SESSION["nombre"]=$fila["nombre"];			
					/*echo "Contraseña e usuario son corecto<br>";*/
					echo "<h2>Buenas, $nombre ves a realizar tu visita: </h2>";
					echo '<h3><a href="Visita.php">Ir a visitar</a></h3>';
				}else{
					echo "<h2>Error: Nombre o código incorrectos</h2>";
					echo '<h3><a href="Jesuita.html">Volver a intentarlo</a></h3>';			
				}
			?>
	    </div>
	</body>
</html>
<?php
	//ELSE DEL PRIMER IF
	}else {
		echo "<h2>Error: Nombre o código incorrectos</h2>";
		echo '<h3><a href="Jesuita.html">Volver a intentarlo</a></h3>';
	}
		
	//Cierra la conexión
	$conexion->close();	
?>