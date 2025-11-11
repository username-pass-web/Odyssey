<?php
/**
 * Procesamiento de registro de usuarios
 * 
 * Funcionalidades:
 * - Verifica si el email ya está registrado
 * - Registra nuevos usuarios en la base de datos
 * - Crea datos iniciales del usuario
 * - Manejo de errores y redirecciones
 */

// Inicia/reanuda la sesión para almacenar mensajes
session_start();

// Incluye archivo de conexión a la base de datos
include '../../config/conex.php';

// Recupera datos del formulario
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

// Verifica si el email ya existe
$check_user = mysqli_query($conex, "SELECT * FROM usuarios WHERE correo_electronico = '$email'");

// Manejo de usuario existente
if (mysqli_num_rows($check_user) > 0) {
    $_SESSION['register_error'] = "Este correo ya está registrado.";
    header("location: ../register.php");
    exit();
} 

// Registro de nuevo usuario
else {
    $register = mysqli_query($conex, "INSERT INTO usuarios (correo_electronico, contraseña, usuario) VALUES ('$email', '$password', '$username')");
    
    // Crea datos iniciales del usuario
    $create_data = mysqli_query($conex, "INSERT INTO usuarios_datos (id_usuario, puntaje, racha) VALUES ( LAST_INSERT_ID(), 0, 0)");
    
    // Manejo de resultado
    if ($register) {
        $_SESSION['success_message'] = "Usuario registrado exitosamente. Ahora puedes iniciar sesión.";
        header("location: ../login.php");
        exit();
    } else {
        $_SESSION['register_error'] = "Error al registrar usuario.";
        header("location: ../register.php");
        exit();
    }
}
?>