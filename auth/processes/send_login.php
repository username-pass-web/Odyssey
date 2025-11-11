<?php
/**
 * Procesamiento de inicio de sesión
 * 
 * Funcionalidades:
 * - Verifica credenciales contra la base de datos
 * - Inicia sesión de usuario válido
 * - Redirecciona al dashboard principal
 * - Maneja errores de autenticación
 */

// Inicia sesión para almacenar estado del usuario
session_start();

// Incluye archivo de conexión
include '../../config/conex.php';

// Recupera credenciales
$email = $_POST["email"];
$password = $_POST["password"];

// Consulta de verificación
$login = mysqli_query($conex, "SELECT * FROM usuarios WHERE correo_electronico = '$email' and contraseña = '$password'");
    
// Autenticación exitosa
if ($login && mysqli_num_rows($login) > 0) {
    $row = mysqli_fetch_array($login);
    
    // Almacena datos de sesión
    $_SESSION['id'] = $row['id'];
    $_SESSION['user'] = $row['usuario'];
    
    // Redirección a dashboard
    header("location: ../../home/dashboard.php");
    exit();
} 

// Credenciales inválidas
else {
    $_SESSION['login_error'] = "Correo y/o contraseña son incorrectos.";
    header("location: ../login.php");
    exit();
}
?>