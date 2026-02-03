
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
<div>
	<header>
		<h1>APLICACION CRUD PHP</h1>
	</header>
	<main>				
	<h2>Registro</h2>

	<!--FORMULARIO DE REGISTRO. Al hacer click en el botón Aceptar, llama a la página: registro_action.php (form action="registro_action.php")-->
	<form action="registro_action.php" method="post">
		<div>
			<label for="email">Correo</label>
			<input type="email" name="email" id="email" placeholder="correo electrónico" required>
		</div>
		<div>
			<label for="username">Usuario</label>
			<input type="text" name="username" id="username" placeholder="nombre usuario" required>
		</div>
		<div>
			<label for="name">Contraseña</label>
			<input type="password" name="password" id="password" placeholder="contraseña" required>
		</div>
		<div>
			<button type="submit" name="inserta" value="si">Aceptar</button>
			<button type="button" onclick="location.href='index.php'">Cancelar</button>
		</div>
	</form>
	
	</main>	
	<footer>
	<p><a href="login.php">Ya tienes una cuenta? Iniciar sesión (Sign in)</a></p>		
	Created by the IES Miguel Herrero team &copy; 2026
  	</footer>
</div>
</body>
</html>