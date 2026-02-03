<?php
//Incluye fichero con parámetros de conexión a la base de datos
include_once("config.php");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>Inicio</title>
</head>
<body>
<div>
	<header>
		<h1>APLICACION CRUD PHP</h1>
	</header>
	<main>				
	<?php
	/* Se Comprueba si se ha llegado a esta página PHP a través del formulario de login. 
	Para ello se comprueba la variable de formulario: "inicia" enviada al pulsar el botón Iniciar sesión.
	Los datos del formulario se acceden por el método: POST
	*/
	//echo $_POST['inicia'].'<br>';
	if (isset($_POST['inicia'])) {
		//echo $_POST['email'].'<br>';
		$email = $mysqli->real_escape_string($_POST['email']);
		//echo $_POST['password'].'<br>';
		$password = $mysqli->real_escape_string($_POST['password']);

		//Se comprueba si existen campos del formulario vacíos (email o password).
		if (empty($email) || empty($password)) {
			$_SESSION['login_error'] = 'Completa email y contraseña';
			//echo 'Completa email y contraseña<br>';
			header("Location: login.php");
			exit();
		} //fin si
		else 
		{
			//Se comprueba si los datos son correctos. Se busca el usuario en la base de datos por su email y se compara su contraseña
			//Se ejecuta una sentencia SQL. Selecciona (busca) el registro
			$sql="SELECT nombre_usuario, nombre, apellido, correo, contrasena FROM empleados WHERE correo = '$email'";
			//echo 'SQL: ' . $sql . '<br>';
			$resultado = $mysqli->query($sql);
			if ($resultado->num_rows === 0) {
				$_SESSION['login_error'] = 'Usuario incorrecto';
				//echo 'Usuario incorrecto<br>';
				header("Location: login.php");
				exit();
			} //fin si
			else
			{
				//Obtiene el registro del usuario y lo guarda en el array asociativo $fila
				//Nota: También se puede utilizar el método fetch_assoc de la siguiente manera: $fila = $resultado->fetch_assoc();
				//Comprueba la contraseña. Recuerda que en este ejemplo la contraseña se almacena en texto plano (no es seguro). En un entorno real debe estar cifrada o al menos hasheada
				$fila = $resultado->fetch_array();
				if ($password !== $fila['contrasena']) {
					//Contraseña incorrecta
					$_SESSION['login_error'] = 'Contraseña incorrecta';
					echo 'Contraseña incorrecta<br>';
					header("Location: login.php");
					exit();
				} //fin si
				else {
					//Datos correctos
					//echo $fila['nombre_usuario'].'<br>';
					//echo $fila['nombre'].'<br>';
					//echo $fila['apellido'].'<br>';
					//echo $fila['correo'].'<br>';

					//Se crean las variables de sesión
					$_SESSION['username'] = $fila['nombre_usuario'];
					$_SESSION['name'] = $fila['nombre'];
					$_SESSION['surname'] = $fila['apellido'];
					$_SESSION['email'] = $fila['correo'];
					header("Location: home.php");
					exit();
				} //fin sino
			} //fin sino
		}
		//Se cierra la conexión de base de datos
		$mysqli->close();
	} //fin si
	?>
	</main>	
</div>
</body>
</html>
