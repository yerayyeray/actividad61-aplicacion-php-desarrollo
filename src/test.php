<?php
include("config.php");
if ($mysqli->connect_error) {
    die("🔴 ERROR: No puedo conectar a la DB. Revisa config.php y el host 'db'");
} else {
    echo "🟢 ÉXITO: PHP conecta correctamente con MariaDB.";
    $res = $mysqli->query("SELECT COUNT(*) as total FROM usuarios");
    $data = $res->fetch_assoc();
    echo "<br>Usuarios en la tabla: " . $data['total'];
}
?>