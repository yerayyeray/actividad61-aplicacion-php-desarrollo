<?php
// index.php
session_start();
include_once("config.php");

// Si el usuario ya ha iniciado sesión se le redirige a la página home.php
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos - Project Zomboid Traits</title>
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
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .welcome-card {
            background-color: white; /* Fondo blanco solicitado */
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            max-width: 600px;
            width: 90%;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }
        .logo-main {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }
        h1 {
            color: #333;
            font-weight: 800;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        .btn-custom {
            padding: 12px 30px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.85rem;
            color: #777;
        }
    </style>
</head>
<body>

<div class="welcome-card">
    <header>
        <img src="html/logo.png" alt="logo" class="logo-main">
        <h1>Rasgos Project Zomboid</h1>
        <p class="text-muted mb-4">Gestiona y consulta la base de datos de rasgos para tus supervivientes.</p>
    </header>

    <main>
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
            <a href="login.php" class="btn btn-primary btn-custom shadow-sm">Iniciar Sesión</a>
            <a href="registro.php" class="btn btn-success btn-custom shadow-sm">Registrarse</a>
        </div>
    </main>

    <footer>
        <p class="mb-0">Created by <strong>Yeray Gutiérrez Mullor</strong></p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>