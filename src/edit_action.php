<?php
session_start();
include_once("config.php");
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
    /* Ruta a tu imagen según tu estructura de carpetas */
    background-image: url('img/fondoweb.jpg'); 
    
    /* Esto hace que la imagen cubra todo sin repetirse */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed; /* Mantiene el fondo quieto al hacer scroll */
    
    /* Elimina márgenes por defecto del navegador que causan bordes blancos */
    margin: 0;
    padding: 0;
    min-height: 100vh;
	}
	label {
    color: white;
}

/* Para el título "Rasgos de Project Zomboid" */
h1, h2, h3 {
    color: white;
}
	</style>
</head>
<body>
<div>
	<header>
		<h1>Rasgos de Project Zomboid</h1>
	</header>
	<main>				

<?php
/*Se comprueba si se ha llegado a esta página PHP a través del formulario de edición. 
Para ello se comprueba la variable de formulario: "modifica" enviada al pulsar el botón Guardar de dicho formulario.
Los datos del formulario se acceden por el método: POST
*/

if(isset($_POST['modifica'])) {
	$identificador = isset($_POST['identificador']) ? intval($_POST['identificador']) : 0;
	$nombre_rasgo = isset($_POST['nombre_rasgo']) ? trim($mysqli->real_escape_string($_POST['nombre_rasgo'])) : '';
	$puntos_coste = isset($_POST['puntos_coste']) ? intval($_POST['puntos_coste']) : 0;
	$descripcion_efecto = isset($_POST['descripcion_efecto']) ? trim($mysqli->real_escape_string($_POST['descripcion_efecto'])) : '';
	$es_positivo = isset($_POST['es_positivo']) ? intval($_POST['es_positivo']) : 0;

	//Se comprueba si existen campos del formulario vacíos
	if(empty($nombre_rasgo) || empty($descripcion_efecto) || $identificador <= 0) 
	{
		echo "<div style='color:red;'>";
		if($identificador <= 0) {
			echo "ID inválido.<br>";
		}
		if(empty($nombre_rasgo)) {
			echo "Campo nombre rasgo vacío.<br>";
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
		//Se actualiza el registro a modificar: update
		$sql = "UPDATE rasgos SET nombre_rasgo = '$nombre_rasgo', puntos_coste = $puntos_coste, 
				descripcion_efecto = '$descripcion_efecto', es_positivo = $es_positivo 
				WHERE rasgos_id = $identificador";
		
		if($mysqli->query($sql)) {
			$mysqli->close();
			echo "<div style='color:green;'>Rasgo editado correctamente.</div>";
			echo "<a href='home.php'>Ver resultado</a>";
		} else {
			echo "<div style='color:red;'>Error al editar el rasgo: " . htmlspecialchars($mysqli->error) . "</div>";
			$mysqli->close();
			echo "<a href='javascript:self.history.back();'>Volver atrás</a>";
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

