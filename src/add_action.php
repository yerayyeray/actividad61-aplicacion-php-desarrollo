<?php
//Incluye fichero con parámetros de conexión a la base de datos
include_once("config.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>Agregar Rasgo</title>
</head>
<body>
<div>
	<header>
		<h1>Rasgos de Project Zomboid </h1>
	</header>
	<main>

<?php

if(isset($_POST['inserta'])) 
{
	$nombre_rasgo = isset($_POST['nombre_rasgo']) ? trim($mysqli->real_escape_string($_POST['nombre_rasgo'])) : '';
	$codigo_rasgo = isset($_POST['codigo_rasgo']) ? trim($mysqli->real_escape_string($_POST['codigo_rasgo'])) : '';
	$puntos_coste = isset($_POST['puntos_coste']) ? intval($_POST['puntos_coste']) : 0;
	$descripcion_efecto = isset($_POST['descripcion_efecto']) ? trim($mysqli->real_escape_string($_POST['descripcion_efecto'])) : '';
	$es_positivo = isset($_POST['es_positivo']) ? intval($_POST['es_positivo']) : 0;

	// Validación de campos vacíos
	if(empty($nombre_rasgo) || empty($codigo_rasgo) || empty($descripcion_efecto)) 
	{
		echo "<div style='color:red;'>";
		if(empty($nombre_rasgo)) {
			echo "Campo nombre rasgo vacío.<br>";
		}
		if(empty($codigo_rasgo)) {
			echo "Campo código rasgo vacío.<br>";
		}
		if(empty($descripcion_efecto)) {
			echo "Campo descripción vacío.<br>";
		}
		echo "</div>";
		$mysqli->close();
		echo "<a href='javascript:self.history.back();'>Volver atrás</a>";
	} 
	else 
	{
		// Verificar si codigo_rasgo ya existe
		$check_sql = "SELECT rasgos_id FROM rasgos WHERE codigo_rasgo = '$codigo_rasgo'";
		$check_result = $mysqli->query($check_sql);
		
		if($check_result->num_rows > 0) {
			echo "<div style='color:red;'>El código de rasgo ya existe. Intente con otro.</div>";
			$mysqli->close();
			echo "<a href='javascript:self.history.back();'>Volver atrás</a>";
		} else {
			// Insertar el nuevo rasgo
			$sql="INSERT INTO rasgos (nombre_rasgo, codigo_rasgo, puntos_coste, descripcion_efecto, es_positivo) 
					VALUES ('$nombre_rasgo', '$codigo_rasgo', $puntos_coste, '$descripcion_efecto', $es_positivo)";
			
			if($mysqli->query($sql)) {
				$mysqli->close();
				echo "<div style='color:green;'>Rasgo añadido correctamente.</div>";
				echo "<a href='home.php'>Ver resultado</a>";
			} else {
				echo "<div style='color:red;'>Error al añadir el rasgo: " . htmlspecialchars($mysqli->error) . "</div>";
				$mysqli->close();
				echo "<a href='javascript:self.history.back();'>Volver atrás</a>";
			}
		}
	}
}
?>
 	
	</main>
	<footer>
		<p><a href="home.php">Volver</a></p>	
		<p><a href="logout.php">Cerrar sesión (Sign out) <?php echo $_SESSION['username']; ?></a></p>
		Created by Yeray Gutiérrez Mullor
  	</footer>
</div>
</body>
</html>
