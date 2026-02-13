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
/*Obtiene el id del registro del rasgo a eliminar, identificador, a partir de su URL. Se recibe el dato utilizando el método: GET*/

//Recoge el id del rasgo a eliminar a través de la clave identificador del array asociativo $_GET
$identificador = isset($_GET['identificador']) ? intval($_GET['identificador']) : 0;

if($identificador <= 0) {
	echo "<div style='color:red;'>ID inválido.</div>";
	echo "<a href='home.php'>Volver</a>";
	exit();
}

//Se realiza el borrado del registro: delete.
$sql="DELETE FROM rasgos WHERE rasgos_id = $identificador";
//echo 'SQL: ' . $sql . '<br>';

if($mysqli->query($sql)) {
	$mysqli->close();
	echo "<div style='color:green;'>Rasgo eliminado correctamente.</div>";
	echo "<a href='home.php'>Ver resultado</a>";
} else {
	echo "<div style='color:red;'>Error al eliminar el rasgo: " . htmlspecialchars($mysqli->error) . "</div>";
	$mysqli->close();
	echo "<a href='home.php'>Volver</a>";
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

