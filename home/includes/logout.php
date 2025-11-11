<?php 
/**
 * Procesa el cierre de sesión del usuario
 * 
 * Funcionalidades:
 * - Inicia la sesión
 * - Destruye todas las variables de sesión
 * - Destruye la sesión
 * - Redirige al usuario a la página de login
 */

// Iniciar sesión para acceder a las variables
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir completamente la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header("location: ../../auth/login.php");
?>