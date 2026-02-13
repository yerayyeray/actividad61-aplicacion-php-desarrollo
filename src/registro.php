<?php
include_once("config.php");
session_start();

// Cambiamos 'registra' por 'inserta' para que coincida con tu botón
if (isset($_POST['inserta'])) {
    
    $username = isset($_POST['username']) ? trim($mysqli->real_escape_string($_POST['username'])) : '';
    $email    = isset($_POST['email']) ? trim($mysqli->real_escape_string($_POST['email'])) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';

    // 1. Validar campos vacíos
    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['registro_error'] = "Todos los campos son obligatorios.";
        header("Location: registro.php");
        exit();
    }

    // 2. Validar que las contraseñas coincidan
    if ($password !== $password_confirm) {
        $_SESSION['registro_error'] = "Las contraseñas no coinciden.";
        header("Location: registro.php");
        exit();
    }
    
    if (isset($_SESSION['registro_error'])) {
    echo '<div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #f5c6cb;">';
    echo '<strong>⚠️ Error:</strong> ' . $_SESSION['registro_error'];
    echo '</div>';
    
    // Importante: borramos el mensaje para que no aparezca siempre
    unset($_SESSION['registro_error']);
}
    // 3. Encriptar contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // 4. Insertar en la base de datos
    $sql = "INSERT INTO usuarios (nombre_usuario, correo, contrasena) VALUES ('$username', '$email', '$passwordHash')";

    if ($mysqli->query($sql)) {
        header("Location: registro_success.php");
        exit();
    } else {
        // Si el usuario o correo ya existen
        $_SESSION['registro_error'] = "Error: El usuario o correo ya están registrados.";
        header("Location: registro.php");
        exit();
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro - Project Zomboid</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {

            background-image: url('img/fondoweb.jpg');

            background-size: cover;

            background-position: center;

            background-repeat: no-repeat;

            background-attachment: fixed;

            min-height: 100vh;

            display: flex;

            flex-direction: column;

        }

        .main-container {

            flex: 1;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 20px;

        }

        .card {

            background-color: rgba(255, 255, 255, 0.95);

            border: none;

            border-radius: 15px;

            box-shadow: 0 10px 30px rgba(0,0,0,0.5);

            width: 100%;

            max-width: 500px;

        }

        .form-label {

            font-weight: bold;

            color: #333;

        }

    </style>

</head>

<body>



<nav class="navbar navbar-dark bg-dark shadow shadow-sm">

    <div class="container">

        <a class="navbar-brand" href="index.php">

            <img src="html/logo2.jpg" alt="logo" width="30" height="30" class="d-inline-block align-text-top me-2">

            Rasgos de Project Zomboid

        </a>

    </div>

</nav>



<div class="main-container">

    <div class="card">

        <div class="card-body p-4">

            <h3 class="card-title text-center mb-4">Crear Nueva Cuenta</h3>



            <?php

            // Manejo de mensajes de error o éxito

            if(isset($_SESSION['registro_error'])) {

                echo "<div class='alert alert-danger border-0 small'>" . htmlspecialchars($_SESSION['registro_error']) . "</div>";

                unset($_SESSION['registro_error']);

            }

            if(isset($_SESSION['registro_success'])) {

                echo "<div class='alert alert-success border-0 small'>" . htmlspecialchars($_SESSION['registro_success']) . "</div>";

                unset($_SESSION['registro_success']);

            }

            ?>



            <form action="registro_action.php" method="post">

                <div class="row">

                    <div class="col-md-12 mb-3">

                        <label for="email" class="form-label">Correo Electrónico</label>

                        <input type="email" name="email" id="email" class="form-control" placeholder="ejemplo@correo.com" required>

                    </div>

                    <div class="col-md-12 mb-3">

                        <label for="username" class="form-label">Nombre de Usuario</label>

                        <input type="text" name="username" id="username" class="form-control" placeholder="Tu apodo" required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label for="password" class="form-label">Contraseña</label>

                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label for="password_confirm" class="form-label">Confirmar</label>

                        <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="••••••••" required>

                    </div>

                </div>



                <div class="d-grid gap-2 mt-3">

                    <button type="submit" name="inserta" value="si" class="btn btn-success btn-lg shadow-sm">Registrar cuenta</button>

                    <a href="login.php" class="btn btn-outline-secondary">¿Ya tienes cuenta? Inicia sesión</a>

                </div>

            </form>

        </div>

    </div>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>