<?php
/*Incluye parámetros de conexión a la base de datos: 
DB_HOST: Nombre o dirección del gestor de BD MariaDB
DB_NAME: Nombre de la BD
DB_USER: Usuario de la BD
DB_PASSWORD: Contraseña del usuario de la BD
*/
include_once("config.php");

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$name = $_SESSION['name'] ?? '';
$surname = $_SESSION['surname'] ?? '';
$email = $_SESSION['email'] ?? '';
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
	Bienvenido, <?php echo htmlspecialchars($name . " " . $surname); ?><br>
    Email: <?php echo htmlspecialchars($email); ?>
	
	<p><a href="add.php">Alta</a></p>	

	<table border="1">
	<thead>
		<tr>
			<th>Usuario</th>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Edad</th>
			<th>Puesto</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbdody>

<?php
/*Se realiza una consulta de selección la tabla empleados ordenados y almacena todos los registros en una estructura especial PARECIDA a una "tabla" llamada $resultado.
Cada fila y cada columna de la tabla se corresponde con un registro y campo de la tabla EMPLEADOS.
*/
$sql="SELECT * FROM empleados ORDER BY apellido, nombre";
//echo $sql.'<br>';
$resultado = $mysqli->query($sql);

//Cierra la conexión de la BD
$mysqli->close();

/*
A continuación indicamos distintos manera de leer cada fila de la tabla anterior: 
mysqli_fetch_array()- Almacena una fila (o registro) de la tabla anterior, $resultado, en un array asociativo, numérico o ambos
mysqli_fetch_assoc()-  Almacena una fila de la tabla anterior, , $resultado, SOLO en un array asociativo
mysqli_fetch_row() - Almacena una fila de la tabla anterior, , $resultado, en un array numérico

Veamos la diferencia entre un array numérico y asosiativo. Antes que nada supongamos que hemos leido el 1º registro de la tabla:
id=1
nombre_usuario=javier
contrasena=usuario@1
correo=javier@gmail.com
apellido=Coloma
nombre=Javier
edad=25
puesto=contable
creacion=Fecha y hora de creacion

ARRAYS NUMÉRICO (se accede por índice). Donde los índices se corresponde con la POSICIÓN de cada campo en la tabla de empleados: 0->id, 1->Apellido, 2->Nombre, 3->Edad y 4-> Puesto
$fila[0] -> Contiene el contenido del campo id del empleado actual: 1
$fila[1] -> Contiene el contenido del campo nombre_usuario: javier
$fila[2] -> Contiene el contenido del campo contrasena: usuario
$fila[3] -> Contiene el contenido del campo correo:javier@gmail.com
$fila[4] -> Contiene el contenido del campo apellido: Coloma
$fila[5] -> Contiene el contenido del campo nombre: Javier 
$fila[6] -> Contiene el contenido del campo edad: 25
$fila[7] -> Contiene el el contenido del campo puesto: contable
$fila[8] -> Contiene el el contenido del campo creacion: Fecha y hora de creacion

ARRAYS ASOCIATIVO (se acceder por nombre): Donde los índices (conocidos como claves) se corresponde con el NOMBRE de cada campo de la tabla de empleados: id, apellido, nombre, edad y puesto.
$fila["id"] -> Contiene el contenido del campo id del empleado actual: 1
$fila["nombre_usuario"] -> Contiene el contenido del campo nombre_usuario: javier
$fila["contrasena"] -> Contiene el contenido del campo contrasena: usuario
$fila["correo"] -> Contiene el contenido del campo correo:javier@gmail.com
$fila["apellido"] -> Contiene el contenido del campo apellido: Coloma
$fila["nombre"] -> Contiene el contenido del campo nombre: Javier 
$fila["edad"] -> Contiene el contenido del campo edad: 25
$fila["puesto"] -> Contiene el el contenido del campo puesto: contable
$fila["creacion"] -> Contiene el el contenido del campo creacion: Fecha y hora de creacion


*/

//Comprobamos si el nº de fila/registros es mayor que 0. La consulta genera un resultado válido
 if ($resultado->num_rows > 0) {

/* A través de la estructura repetitiva "while" se recorre la "tabla" $resultados almacenando cada línea/registro en el array asociativo $fila. 
Recuerda que $fila contiene el contenido de todos los campos del registro actual tal como explicamos anteriormente.
El bucle finaliza cuando se llegue a la última línea (o registro) de la tabla $resultado. 
A medida que avanza se va construyendo cada fila de la tabla HTML con todos los campos del empleado, hasta completar todos los registros.
De los nueves campos de la tabla empleados solo se muestran algunos en la tabla HTML: nombre_usuario, nombre, apellido, edad y puesto.
*/

	while($fila = $resultado->fetch_array()) {
		echo "<tr>\n";
		echo "<td>".$fila['nombre_usuario']."</td>\n";
		echo "<td>".$fila['nombre']."</td>\n";
		echo "<td>".$fila['apellido']."</td>\n";
		echo "<td>".$fila['edad']."</td>\n";
		echo "<td>".$fila['puesto']."</td>\n";
		echo "<td>";
/* En la última columna se añade dos enlaces para editar y modificar el registro correspondiente. 
Los datos se pueden enviar entre distintas páginas siguiendo distintos métodos. En este caso el id del registro a editar/eliminar se pasa a través de la URL. 
Este forma de pasar el dato se conoce como: método GET*/
		echo "<a href=\"edit.php?identificador=$fila[id]\">Edición</a>\n";
		echo "<a href=\"delete.php?identificador=$fila[id]\" onClick=\"return confirm('¿Está segur@ que desea eliminar el empleado/a?')\" >Baja</a></td>\n";
		echo "</td>";
		echo "</tr>\n";
	}//fin mientras
 }//fin si
?>
	</tbdody>
	</table>
	</main>
	<footer>
		<p><a href="logout.php">Cerrar sesión (Sign out) <?php echo $_SESSION['username']; ?></a></p>
    	Created by the IES Miguel Herrero team &copy; 2026
  	</footer>
</div>
</body>
</html>
