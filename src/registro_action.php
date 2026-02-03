<?php

include_once("config.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>Registro</title>
</head>
<body>
	<header>
		<h1>APLICACION CRUD PHP</h1>
	</header>
	<main>

<?php

	//echo $_POST['inserta'].'<br>';
	if(isset($_POST['inserta'])) 
	{
		$email = $mysqli->real_escape_string($_POST['email']);
		$username = $mysqli->real_escape_string($_POST['username']);
		$password = $mysqli->real_escape_string($_POST['password']);
		
		if(empty($email) || empty($username) || empty($password) ) 
		{
			if(empty($email)) {
				echo "<div>Campo correo electrónico vacío.</div>";
			}
			if(empty($username)) {
				echo "<div>Campo nombre de usuario vacío.</div>";
			}
			if(empty($password)) {
				echo "<div>Campo contraseña vacío.</div>";
			}
			
			$mysqli->close();
			echo "<a href='javascript:self.history.back();'>Volver atras</a>";
		} //fin si
		else //Sino existen campos de formulario vacíos se procede al alta del nuevo registro
		{
	//Se ejecuta una sentencia SQL. Inserta (da de alta) el nuevo registro: insert.
			//echo 'Email: ' . $email . '<br>';
			//echo 'Usuario: ' . $username . '<br>';
			//echo 'Contraseña: ' . $password . '<br>';
			$result = $mysqli->query("INSERT INTO empleados (correo, nombre_usuario, contrasena) VALUES ('$email', '$username', '$password')");	
			//Se cierra la conexión
			$mysqli->close();
			//echo "<div>Usuario registrado correctamente...</div>";
			//echo "<a href='index.php'>Volver</a>";
			//Se redirige a la página principal: index.php
			header("Location:index.php");
		}//fin sino
	}
	?>

		<!--<div>Registro añadido correctamente</div>
		<a href='index.php'>Ver resultado</a>-->
	</main>
</body>
</html>
