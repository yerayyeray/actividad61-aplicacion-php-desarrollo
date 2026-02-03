<?php
//Incluye fichero con parámetros de conexión a la base de datos
include_once("config.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>Altas</title>
</head>
<body>
<div>
	<header>
		<h1>APLICACION CRUD PHP</h1>
	</header>
	<main>

<?php
/* Se Comprueba si se ha llegado a esta página PHP a través del formulario de altas. 
Para ello se comprueba la variable de formulario: "inserta" enviada al pulsar el botón Agregar.
Los datos del formulario se acceden por el método: POST
*/

//echo $_POST['inserta'].'<br>';
if(isset($_POST['inserta'])) 
{
/*Se obtienen los datos del usuario/empleado (nombre_usuario, correo, contraseña, nombre, apellido, edad y puesto) a partir del formulario de alta (username, email, password, name, surname, age y job)  por el método POST.

Se envía a través del body del mensaje HTTP Request. No aparecen en la URL como era el caso del otro método de envío de datos: GET

Recuerda que   existen dos métodos con los que el navegador puede enviar información al servidor:

1.- Método HTTP GET. Información se envía de forma visible. A través de la URL (header HTTP Request )
En PHP los datos se administran con el array asociativo $_GET. En nuestro caso el dato del empleado se obiene a través de la clave: $_GET['identificador']
2.- Método HTTP POST. Información se envía de forma no visible. A través del cuerpo del HTTP Request 
PHP proporciona el array asociativo $_POST para acceder a la información enviada.
*/

	$email = $mysqli->real_escape_string($_POST['email']);
	$username = $mysqli->real_escape_string($_POST['username']);
	$name = $mysqli->real_escape_string($_POST['name']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$surname = $mysqli->real_escape_string($_POST['surname']);
	$job = $mysqli->real_escape_string($_POST['job']);
	$age = $mysqli->real_escape_string($_POST['age']);
    if (empty($age)) {
    $age = "NULL";} 
	else {
    $age = intval($age);}
	
/*Con mysqli_real_scape_string protege caracteres especiales en una cadena para ser usada en una sentencia SQL.
Esta función es usada para crear una cadena SQL legal que se puede usar en una sentencia SQL. 
Los caracteres codificados son NUL (ASCII 0), \n, \r, \, ', ", y Control-Z.
Ejemplo: Entrada sin escapar: "O'Reilly" contiene una comilla simple (').
Escapado con mysqli_real_escape_string(): Se convierte en "O\'Reilly", evitando que la comilla se interprete como el fin de una cadena en SQL.
*/

//Se comprueba si algunos campos del formulario están vacíos. Es decir no tienen ningún valor útil
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
//Enlace a la página anterior
		//Se cierra la conexión
		$mysqli->close();
		echo "<a href='javascript:self.history.back();'>Volver atras</a>";
	} //fin si
	else //Sino existen campos de formulario vacíos se procede al alta del nuevo registro
	{
	//Se ejecuta una sentencia SQL. Inserta (da de alta) el nuevo registro: insert.
		$sql="INSERT INTO empleados (correo, nombre_usuario, contrasena, nombre, apellido, edad, puesto) VALUES ('$email', '$username', '$password', '$name', '$surname', $age, '$job')";
		//echo 'SQL: ' . $sql . '<br>';
		$result = $mysqli->query($sql);	
		//Se cierra la conexión
		$mysqli->close();
		echo "<div>Empleado añadido correctamente...</div>";
		echo "<a href='home.php'>Ver resultado</a>";
		//Se redirige a la página home: home.php
		//header("Location:home.php");
	}//fin sino
}
?>
 	
	</main>
</div>
</body>
</html>
