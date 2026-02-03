<?php
/*Incluye parámetros de conexión a la base de datos: 
DB_HOST: Nombre o dirección del gestor de BD MariaDB
DB_NAME: Nombre de la BD
DB_USER: Usuario de la BD
DB_PASSWORD: Contraseña del usuario de la BD
*/
include_once("config.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>CRUD PHP</title>
</head>
<body>
<div>
	<header>
		<h1>APLICACION CRUD PHP</h1>
	</header>
	<main> 
	<?php
	session_start();
	//Asigna a la variable $error:
	//el valor de $_SESSION['login_error'] si existe y no es null
	//o una cadena vacía '' si no existe

	$error = $_SESSION['login_error'] ?? '';
	unset($_SESSION['login_error']);
	?>

	
	<?php 
	//Muestra el mensaje de error si existe
	if ($error !== ""): ?>
		<p style="color:#b00020;"><?php echo $error;?></p>
	<?php endif; ?>

	<!--Se solicitan las credenciales de acceso: email y password-->
	<!--FORMULARIO DE LOGIN. Al hacer click en el botón Iniciar sesión, llama a la página: login_action.php (form action="login_action.php")-->
	<form method="post" action="login_action.php">
			<div>
				<label for="email">Email</label>
				<input type="email" name="email" id="email" placeholder="correo electrónico" required>
			</div>
			<div>
				<label for="password">Contraseña</label>
				<input type="password" name="password" id="password" placeholder="contraseña" required>
			</div>
		<button type="submit" name="inicia" value="si">Iniciar sesión</button>
	</form>
	<p><a href="index.php">Volver</a></p>
	</main>
	<footer>
    	Created by the IES Miguel Herrero team &copy; 2026
  	</footer>
</div>
</body>
</html>
