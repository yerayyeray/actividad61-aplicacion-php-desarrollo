<?php
//Incluye fichero con parámetros de conexión a la base de datos
include_once("config.php");
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

<?php
/*Se comprueba si se ha llegado a esta página PHP a través del formulario de edición. 
Para ello se comprueba la variable de formulario: "modifica" enviada al pulsar el botón Guardar de dicho formulario.
Los datos del formulario se acceden por el método: POST
*/

//echo $_POST['modifica'].'<br>';
if(isset($_POST['modifica'])) {
/*Se obtienen los datos del empleado (id, nombre, apellido, edad y puesto) a partir del formulario de edición (identificador, name, surname, age y job)  por el método POST.
Se envía a través del body del HTTP Request. No aparecen en la URL como era el caso del otro método de envío de datos: GET
Recuerda que   existen dos métodos con los que el navegador puede enviar información al servidor:
1.- Método HTTP GET. Información se envía de forma visible. A través de la URL (header HTTP Request )
En PHP los datos se administran con el array asociativo $_GET. En nuestro caso el dato del empleado se obiene a través de la clave: $_GET['identificador']
2.- Método HTTP POST. Información se envía de forma no visible. A través del cuerpo del HTTP Request 
PHP proporciona el array asociativo $_POST para acceder a la información enviada.
*/

	$identificador = $mysqli->real_escape_string($_POST['identificador']);
	$username = $mysqli->real_escape_string($_POST['username']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$email = $mysqli->real_escape_string($_POST['email']);
	$name = $mysqli->real_escape_string($_POST['name']);
	$surname = $mysqli->real_escape_string($_POST['surname']);
	$age = $mysqli->real_escape_string($_POST['age']);
	$job = $mysqli->real_escape_string($_POST['job']);
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

//Se comprueba si existen campos del formulario vacíos
	if(empty($email) || empty($username) || empty($password)) 
	{
		if(empty($email)) {
			echo "<div>Campo email vacío.</div>";
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
	else //Se realiza la modificación de un registro de la BD. 
	{
		//Se actualiza el registro a modificar: update
		$sql="UPDATE empleados SET nombre_usuario = '$username', contrasena = '$password', correo = '$email', nombre = '$name', apellido = '$surname',  edad = $age, puesto = '$job' WHERE id = $identificador";
		//echo 'SQL: ' . $sql . '<br>';
		$mysqli->query($sql);
		$mysqli->close();
        echo "<div>Empleado editado correctamente...</div>";
		echo "<a href='home.php'>Ver resultado</a>";
        //Se redirige a la página principal: home.php
        //header("Location: home.php");
	}// fin sino
}//fin si
?>

    
	</main>	
</div>
</body>
</html>

