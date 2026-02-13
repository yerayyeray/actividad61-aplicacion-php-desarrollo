<?php
include_once("config.php");
session_start();

if (isset($_POST['inserta'])) {
    $username = isset($_POST['username']) ? trim($mysqli->real_escape_string($_POST['username'])) : '';
    $email    = isset($_POST['email']) ? trim($mysqli->real_escape_string($_POST['email'])) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['registro_error'] = "Todos los campos son obligatorios.";
        header("Location: registro.php");
        exit();
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre_usuario, correo, contrasena) VALUES ('$username', '$email', '$passwordHash')";

    if ($mysqli->query($sql)) {
        // En lugar de registro_success, lo mandamos al login con un mensaje positivo
        $_SESSION['login_success'] = "¡Registro completado! Ya puedes iniciar sesión.";
        header("Location: login.php");
        exit();
    } else {
        if ($mysqli->errno == 1062) {
            $_SESSION['registro_error'] = "Ese usuario o correo ya está registrado.";
        } else {
            $_SESSION['registro_error'] = "Error: " . $mysqli->error;
        }
        header("Location: registro.php");
        exit();
    }
    try {
    $sql = "INSERT INTO usuarios (nombre_usuario, correo, contrasena) 
            VALUES ('$username', '$email', '$passwordHash')";
    
    if ($mysqli->query($sql)) {
        header("Location: login.php?registro=exito");
    }
} catch (mysqli_sql_exception $e) {
    if ($mysqli->errno == 1062) {
        header("Location: registro.php?error=duplicado");
    } else {
        echo "Error crítico: " . $e->getMessage();
    }
}
exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Finalizado - Project Zomboid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* Ruta corregida a tu carpeta img/ */
            background-image: url('img/fondoweb.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .status-card {
            background-color: white; /* Fondo blanco solicitado */
            color: #333;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            max-width: 500px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }
        .navbar-custom {
            background-color: rgba(0, 0, 0, 0.8);
            position: absolute;
            top: 0;
            width: 100%;
        }
        .header-title {
            color: #d9534f; /* Rojo oscuro para el título principal */
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark navbar-custom shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="html/logo2.jpg" alt="logo" width="30" height="30" class="d-inline-block align-text-top me-2">
            APLICACIÓN CRUD PHP
        </a>
    </div>
</nav>

<div class="container d-flex justify-content-center">
    <div class="status-card">
        <h2 class="header-title">Registro de Usuario</h2>
        
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <strong>¡Éxito!</strong> Los datos se han enviado correctamente.
        </div>
        
        <p class="lead mb-4">El proceso de registro ha finalizado. Ahora puedes acceder a la plataforma con tus credenciales.</p>
        
        <div class="d-grid shadow-sm">
            <a href="login.php" class="btn btn-primary btn-lg">Ir al Inicio de Sesión</a>
        </div>
        
        <p class="mt-4 text-muted small">Serás redirigido automáticamente en unos segundos...</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>