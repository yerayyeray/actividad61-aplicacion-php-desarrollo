<?php
// edit.php
session_start();
include_once("config.php");

// 1. Control de acceso
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
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
    <title>Editar Rasgo - Project Zomboid</title>
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
            background-color: white; /* Fondo blanco solicitado */
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            margin-top: 20px;
            margin-bottom: 40px;
        }
        .navbar-brand img { margin-right: 10px; }
        footer { color: white; text-shadow: 1px 1px 2px black; }
        footer a { color: #ffc107; text-decoration: none; }
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
                <h2 class="text-dark mb-4 border-bottom pb-2">Editar Rasgo</h2>

                <?php
                // Recoger y validar ID
                $identificador = isset($_GET['identificador']) ? intval($_GET['identificador']) : 0;

                if($identificador <= 0) {
                    echo "<div class='alert alert-danger'>ID de rasgo inválido.</div>";
                    echo "<a href='home.php' class='btn btn-secondary'>Volver</a>";
                    exit();
                }

                // Consultar datos del rasgo
                $sql = "SELECT * FROM rasgos WHERE rasgos_id = $identificador";
                $resultado = $mysqli->query($sql);

                if(!$resultado || $resultado->num_rows === 0) {
                    echo "<div class='alert alert-warning'>Rasgo no encontrado.</div>";
                    echo "<a href='home.php' class='btn btn-secondary'>Volver</a>";
                    exit();
                }

                $fila = $resultado->fetch_assoc();
                ?>

                <form action="edit_action.php" method="post">
                    <div class="mb-3">
                        <label for="nombre_rasgo" class="form-label text-dark fw-bold">Nombre del Rasgo</label>
                        <input type="text" name="nombre_rasgo" id="nombre_rasgo" class="form-control" 
                               value="<?php echo htmlspecialchars($fila['nombre_rasgo']);?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="codigo_rasgo" class="form-label text-dark fw-bold">Código Interno</label>
                        <input type="text" name="codigo_rasgo" id="codigo_rasgo" class="form-control bg-light" 
                               value="<?php echo htmlspecialchars($fila['codigo_rasgo']);?>" readonly>
                        <div class="form-text">El código interno no se puede modificar.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="puntos_coste" class="form-label text-dark fw-bold">Puntos de Coste</label>
                            <input type="number" name="puntos_coste" id="puntos_coste" class="form-control" 
                                   value="<?php echo $fila['puntos_coste'];?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="es_positivo" class="form-label text-dark fw-bold">Categoría</label>
                            <select name="es_positivo" id="es_positivo" class="form-select" required>
                                <option value="1" <?php echo $fila['es_positivo'] == 1 ? 'selected' : ''; ?>>Positivo</option>
                                <option value="0" <?php echo $fila['es_positivo'] == 0 ? 'selected' : ''; ?>>Negativo</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="descripcion_efecto" class="form-label text-dark fw-bold">Descripción del Efecto</label>
                        <textarea name="descripcion_efecto" id="descripcion_efecto" class="form-control" 
                                  rows="4" required><?php echo htmlspecialchars($fila['descripcion_efecto']);?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <input type="hidden" name="identificador" value="<?php echo $identificador;?>">
                        <button type="submit" name="modifica" value="si" class="btn btn-primary px-4">Guardar Cambios</button>
                        <a href="home.php" class="btn btn-outline-secondary px-4">Cancelar</a>
                    </div>
                </form>
            </div>

            <footer class="text-center py-3">
                <p class="mb-1">Sesión activa: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> | <a href="logout.php">Cerrar sesión</a></p>
                <p class="small opacity-75">Created by Yeray Gutiérrez Mullor</p>
            </footer>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>