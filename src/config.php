<?php
// Configuración de conexión limpia
define('DB_HOST', 'db'); 
define('DB_PORT', '3306');
define('DB_NAME', 'pz_yeray');
define('DB_USER', 'yeray');
define('DB_PASSWORD', 'usuario@1');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, (int)DB_PORT);
    $mysqli->set_charset("utf8mb4"); // Obligatorio para leer bien los símbolos $ del hash
} catch (mysqli_sql_exception $e) {
    die('Error de conexión crítica');
}