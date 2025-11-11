<?php
/**
 * Muestra perfil de usuario y estadísticas
 * 
 * Funcionalidades:
 * - Recupera datos de usuario de la sesión
 * - Muestra avatar, nombre y estadísticas
 * - Escapa datos para prevenir XSS
 */

// Incluir archivo de conexión
include '../config/conex.php';

// Recuperar datos de usuario de la sesión
$user = htmlspecialchars($_SESSION['user']);  // Nombre de usuario
$id = $_SESSION['id'];  // ID de usuario

// Consultar datos del perfil (puntaje y racha)
$profile = mysqli_query($conex, "SELECT * FROM usuarios_datos WHERE id_usuario = '$id'");
$row = mysqli_fetch_array($profile);
$points = htmlspecialchars($row['puntaje']);   // Puntaje actual
$streak = htmlspecialchars($row['racha']);     // Racha actual

// Cerrar conexión a la base de datos
mysqli_close($conex);
?>

<!-- Sección de perfil - Muestra avatar y mensaje de bienvenida -->
<div class="profile-section">
    <div class="profile-container">
        <div class="profile-avatar"></div>
        <div class="profile-text">
            <h2 class="welcome-text">¡Bienvenido <?= $user ?>!</h2>
            <p class="welcome-subtitle">¿Listo para continuar tu viaje de aprendizaje?</p>
        </div>
    </div>
</div>

<!-- Sección de estadísticas - Muestra puntaje y racha -->
<div class="stats-section">
    <div class="stat-card">
        <p class="stat-label">Puntaje Actual</p>
        <p class="stat-value"><?= $points ?> Puntos</p>
    </div>
    <div class="stat-card">
        <p class="stat-label">Racha Actual</p>
        <p class="stat-value"><?= $streak ?> Días</p>
    </div>
</div>