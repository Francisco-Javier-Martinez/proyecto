<?php
    $nombrejesuita = isset($_GET['nombre']) ? $_GET['nombre'] : 'Invitado';
		
	//Conecta con la base de datos ($conexión)
    include './php/configdb.php'; //include del archivo con los datos de conexión
    $conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8	
	
	$sql1 = "SELECT idJesuita FROM jesuita WHERE nombre='$nombrejesuita'";
	$resultado1 = $conexion->query($sql1);

	// Obtener el idJesuita
	$idJesuita = null;
	if ($fila = $resultado1->fetch_assoc()) {
		$idJesuita = $fila['idJesuita'];
	} 
	
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Visit</title>
        <meta name="autor" content="Francisco Javier Martinez Fernandez">
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/camino.css">
    </head>
    <body>
        <?php
            echo "<h1>Hello, $nombrejesuita. where do you want to go?</h1>";
        ?>
        <form name="Visita" method="get" action="./php/guardarVisita_Ingles.php">
            <!--<label for="idjesuita">ID del Jesuita:</label><br>
            <input type="text" name="idjesuita" placeholder="ID"><br><br>-->
			<input type="hidden" name="idjesuita" value="<?= $idJesuita ?>">
            <label for="lugar">Place:</label><br>
            <select name="ipequipo" placeholder="IP">
                <?php
                    $sql="SELECT * FROM lugar";
                    $resultado=$conexion->query($sql); 
                    // Bucle para crear las opciones del 'select'
                    while ($fila = $resultado->fetch_array()) {
                        echo "<option value=".$fila["ip"].">".$fila["lugar"]."</option>";
                    }
                    // Cierra la conexión
                    $conexion->close();
                ?>
            </select>

            <input type="submit" value="Enviar">
        </form>
    </body>
</html>