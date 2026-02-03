<?php
//Incluye fichero con parámetros de conexión a la base de datos
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bajas</title>
</head>
<body>
<div>
	<header>
		<h1>APLICACION CRUD PHP</h1>
	</header>
	<main>

<?php
/*Obtiene el id del registro del empleado a eliminar, identificador, a partir de su URL. Se recibe el dato utilizando el método: GET 
Recuerda que   existen dos métodos con los que el navegador puede enviar información al servidor:
1.- Método HTTP GET. Información se envía de forma visible. A través de la URL (header HTTP Request )
En PHP los datos se administran con el array asociativo $_GET. En nuestro caso el dato del empleado se obiene a través de la clave: $_GET['identificador']
2.- Método HTTP POST. Información se envía de forma no visible. A través del cuerpo del HTTP Request 
PHP proporciona el array asociativo $_POST para acceder a la información enviada.
*/

//Recoge el id del empleado a eliminar a través de la clave identificador del array asociativo $_GET y lo almacena en la variable identificador
$identificador = $_GET['identificador'];

//Con mysqli_real_scape_string protege caracteres especiales en una cadena para ser usada en una sentencia SQL.
$identificador = $mysqli->real_escape_string($identificador);

//Se realiza el borrado del registro: delete.
$sql="DELETE FROM empleados WHERE id = $identificador";
//echo 'SQL: ' . $sql . '<br>';
$result = $mysqli->query($sql);
//Se cierra la conexión de base de datos previamente abierta
$mysqli->close();
echo "<div>Empleado/a borrado correctamente...</div>";
echo "<a href='home.php'>Ver resultado</a>";
//Se redirige a la página principal: home.php
//header("Location:home.php");
?>
 
    </main>
</div>
</body>
</html>

