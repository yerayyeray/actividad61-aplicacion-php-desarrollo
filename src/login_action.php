<?php
ob_start(); // Bloquea cualquier salida de texto previa para que el header funcione
include_once("config.php");

// Solo iniciamos sesión si no existe una ya
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['inicia'])) {
    $username = isset($_POST['username']) ? trim($mysqli->real_escape_string($_POST['username'])) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($password)) {
        $_SESSION['login_error'] = 'Completa los campos';
        header("Location: login.php");
        exit();
    }

    $sql = "SELECT usuario_id, nombre_usuario, correo, contrasena FROM usuarios WHERE nombre_usuario = '$username' OR correo = '$username'";
    $resultado = $mysqli->query($sql);

    if ($resultado && $resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();
        
        // El TRIM es vital para limpiar basura que MariaDB pueda añadir al final
        $hash_db = trim($fila['contrasena']);

        if (password_verify($password, $hash_db)) {
            $_SESSION['usuario_id'] = $fila['usuario_id'];
            $_SESSION['username'] = $fila['nombre_usuario'];
            header("Location: home.php");
            exit();
        } else {
            $_SESSION['login_error'] = 'Contraseña incorrecta';
        }
    } else {
        $_SESSION['login_error'] = 'Usuario no encontrado';
    }
    
    header("Location: login.php");
    exit();
}
ob_end_flush();