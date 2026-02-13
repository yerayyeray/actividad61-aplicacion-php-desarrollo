<?php
// add.php
session_start();
include_once("config.php");

// Control de acceso: Si no hay sesión iniciada, al login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Rasgo - Project Zomboid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/fondoweb.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
        }
        .form-container {
            background-color: white; /* Bloque de texto blanco */
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            margin-top: 20px;
            margin-bottom: 40px;
        }
        .navbar-brand img { margin-right: 10px; }
        .form-label { color: #333; font-weight: bold; }
        footer { color: white; text-shadow: 1px 1px 2px black; font-size: 0.9rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand" href="home.php">
            <img src="html/logo2.jpg" alt="logo" width="30" height="30" class="d-inline-block align-text-top">
            Rasgos de Project Zomboid
        </a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container">
                <h2 class="text-dark mb-4 border-bottom pb-2">Añadir Nuevo Rasgo</h2>

                <form action="add_action.php" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre_rasgo" class="form-label">Nombre del Rasgo</label>
                            <input type="text" name="nombre_rasgo" id="nombre_rasgo" class="form-control" placeholder="Ejemplo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="codigo_rasgo" class="form-label">Código Interno</label>
                            <input type="text" name="codigo_rasgo" id="codigo_rasgo" class="form-control" placeholder="Ejemplo" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="puntos_coste" class="form-label">Puntos de Coste</label>
                            <input type="number" name="puntos_coste" id="puntos_coste" class="form-control" placeholder="Ejemplo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="es_positivo" class="form-label">Tipo de Rasgo</label>
                            <select name="es_positivo" id="es_positivo" class="form-select" required>
                                <option value="" disabled selected>-- Selecciona tipo --</option>
                                <option value="1">Positivo</option>
                                <option value="0">Negativo</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="descripcion_efecto" class="form-label">Descripción del Efecto</label>
                        <textarea name="descripcion_efecto" id="descripcion_efecto" class="form-control" rows="4" placeholder="Describe qué hace este rasgo en el juego..." required></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" name="inserta" value="si" class="btn btn-primary px-4">Guardar Rasgo</button>
                        <a href="home.php" class="btn btn-outline-secondary px-4">Cancelar</a>
                    </div>
                </form>
            </div>

            <footer class="text-center py-3">
                <p class="mb-0">Created by Yeray Gutiérrez Mullor</p>
                <p class="opacity-75">Panel de Superviviente: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </footer>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>