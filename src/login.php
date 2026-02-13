<?php
// login.php
session_start();
include_once("config.php");

// Si el usuario ya está logueado, lo mandamos al home directamente
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rasgos Project Zomboid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/fondoweb.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 400px;
        }

        .form-label {
            color: #333; /* Cambiado a oscuro para que se lea sobre el fondo blanco de la card */
            font-weight: bold;
        }

        .navbar-brand {
            color: white !important;
            text-shadow: 1px 1px 2px black;
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

<div class="container login-container py-4">
    <div class="card">
        <div class="card-body p-4">
            <h3 class="card-title text-center mb-4">Iniciar Sesión</h3>
            
            <?php if ($error !== ""): ?>
                <div class="alert alert-danger border-0 shadow-sm" role="alert">
                    <small><strong>Error:</strong> <?php echo htmlspecialchars($error);?></small>
                </div>
            <?php endif; ?>

            <form method="post" action="login_action.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario o Email</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Introduce tu usuario" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" name="inicia" value="si" class="btn btn-primary btn-lg shadow-sm">Entrar</button>
                    <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
            
            <hr class="my-4">
            <p class="text-center mb-0 text-muted">
                ¿No tienes cuenta? <a href="registro.php" class="text-primary text-decoration-none">Regístrate aquí</a>
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>