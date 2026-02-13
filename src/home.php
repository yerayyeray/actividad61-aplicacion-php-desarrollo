<?php
// home.php
session_start();
include_once("config.php");

// 1. Control de acceso: Si no hay sesión, al login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 2. Extraer datos de sesión
$username = $_SESSION['username'];
$email = $_SESSION['email'] ?? 'No definido';

$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Rasgos - Project Zomboid</title>
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
        .table-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }
        h4 { color: white; text-shadow: 1px 1px 4px black; }
        .user-info { color: #eee; margin-bottom: 20px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow">
  <div class="container">
    <a class="navbar-brand" href="home.php">
      <img src="html/logo2.jpg" alt="logo" width="30" height="30" class="d-inline-block align-text-top me-2">
      Zomboid Traits Manager
    </a>
    <div class="d-flex">
      <a class="btn btn-outline-light btn-sm me-2" href="add.php">Añadir Nuevo</a>
      <a class="btn btn-danger btn-sm" href="logout.php">Salir</a>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h4>Bienvenido, <?php echo htmlspecialchars($username); ?></h4>
            <p class="user-info">Sesión activa: <?php echo htmlspecialchars($email); ?></p>
        </div>
    </div>

    <div class="table-container mb-5">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Puntos</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // CAMBIO AQUÍ: Ordenado por rasgos_id de menor a mayor
                $sql = "SELECT * FROM rasgos ORDER BY rasgos_id ASC";
                $resultado = $mysqli->query($sql);

                if ($resultado && $resultado->num_rows > 0) {
                    while($fila = $resultado->fetch_assoc()) {
                        $badge = $fila['es_positivo'] 
                            ? '<span class="badge bg-success">Positivo</span>' 
                            : '<span class="badge bg-danger">Negativo</span>';
                        
                        $puntos_class = $fila['puntos_coste'] < 0 ? 'text-danger' : 'text-success';

                        echo "<tr>";
                        echo "<td><strong class='text-dark'>".$fila['rasgos_id']."</strong></td>";
                        echo "<td><strong>".htmlspecialchars($fila['nombre_rasgo'])."</strong></td>";
                        echo "<td><code>".htmlspecialchars($fila['codigo_rasgo'])."</code></td>";
                        echo "<td class='$puntos_class'><strong>".$fila['puntos_coste']."</strong></td>";
                        echo "<td>".htmlspecialchars($fila['descripcion_efecto'])."</td>";
                        echo "<td>$badge</td>";
                        echo "<td class='text-center'>";
                        echo "<div class='btn-group'>";
                        echo "<a href='edit.php?identificador=".$fila['rasgos_id']."' class='btn btn-sm btn-outline-primary'>Editar</a>";
                        echo "<a href='delete.php?identificador=".$fila['rasgos_id']."' class='btn btn-sm btn-outline-danger' onclick=\"return confirm('¿Seguro que quieres eliminar este rasgo?')\">Borrar</a>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No se encontraron rasgos en la base de datos.</td></tr>";
                }
                $mysqli->close();
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>