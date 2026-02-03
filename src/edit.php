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
	<title>Modificaciones</title>
</head>
<body>
<div>
	<header>
		<h1>APLICACION CRUD PHP</h1>
	</header>
	
	<main>				
	<h2>Modificación</h2>

	<?php


	/*Obtiene el id del registro del empleado a modificar, identificador, a partir de su URL. Este tipo de datos se accede utilizando el método: GET*/

	//Recoge el id del empleado a modificar a través de la clave identificador del array asociativo $_GET y lo almacena en la variable identificador
	$identificador = $_GET['identificador'];

	//Con mysqli_real_scape_string protege caracteres especiales en una cadena para ser usada en una sentencia SQL.
	$identificador = $mysqli->real_escape_string($identificador);


	//Se selecciona el registro a modificar: select
	$sql="SELECT nombre_usuario, contrasena, correo, apellido, nombre, edad, puesto FROM empleados WHERE id = $identificador";
	//echo 'SQL: ' . $sql . '<br>';
	$resultado = $mysqli->query($sql);

	//Se extrae el registro y lo guarda en el array $fila
	//Nota: También se puede utilizar el método fetch_assoc de la siguiente manera: $fila = $resultado->fetch_assoc();
	$fila = $resultado->fetch_array();
	$username = $fila['nombre_usuario'];
	$password = $fila['contrasena'];
	$email = $fila['correo'];
	$surname = $fila['apellido'];
	$name = $fila['nombre'];
	$age = $fila['edad'];
	$job = $fila['puesto'];

	//Se cierra la conexión de base de datos
	$mysqli->close();
	?>

<!--FORMULARIO DE EDICIÓN. Al hacer click en el botón Guardar, llama a la página (form action="edit_action.php"): edit_action.php-->

	<form action="edit_action.php" method="post">
		<div>
			<label for="email">Correo</label>
			<input type="email" name="email" id="email" value="<?php echo $email;?>" readonly>
		</div>
		<div>
			<label for="username">Usuario</label>
			<input type="text" name="username" id="username" value="<?php echo $username;?>" readonly>
		</div>
		<div>
			<label for="name">Contraseña</label>
			<input type="password" name="password" id="password" value="<?php echo $password;?>" required>
		</div>	
		<div>
			<label for="name">Nombre</label>
			<input type="text" name="name" id="name" value="<?php echo $name;?>" >
		</div>

		<div>
			<label for="surname">Apellido</label>
			<input type="text" name="surname" id="surname" value="<?php echo $surname;?>">
		</div>

		<div>
			<label for="age">Edad</label>
			<input type="number" name="age" id="age" value="<?php echo $age;?>">
		</div>

		<div>
			<label for="job">Puesto</label>
			<select name="job" id="job" placeholder="puesto">
				<option value="<?php echo $job;?>" selected><?php echo $job;?></option>
				<option value="administrativo">administrativo</option>
				<option value="contable">contable</option>
				<option value="dependiente">dependiente</option>
				<option value="empleado">empleado</option>
				<option value="gerente">gerente</option>
				<option value="repartidor">repartidor</option>
				<option value="repartidor">usuario</option>
			</select>	
		</div>

		<div >
			<input type="hidden" name="identificador" value=<?php echo $identificador;?>>
			<button type="submit" name="modifica" value="si">Aceptar</button>
			<button type="button" onclick="location.href='home.php'">Cancelar</button>
			

			
			
		</div>
	</form>
	</main>	
	<footer>
		<p><a href="home.php">Volver</a></p>	
		<p><a href="logout.php">Cerrar sesión (Sign out) <?php echo $_SESSION['username']; ?></a></p>
		Created by the IES Miguel Herrero team &copy; 2026
  	</footer>
</div>
</body>
</html>

