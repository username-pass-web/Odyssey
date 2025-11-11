<?php
/**
 * Manejo de mensajes del sistema
 * 
 * Funcionalidades:
 * - Unifica mensajes de éxito/error de diferentes fuentes
 * - Genera notificaciones HTML para mostrar al usuario
 * - Soporta múltiples tipos de mensajes (éxito, error)
 */

session_start();

// Configuración inicial
$notification_message = '';
$notification_type = 'error';

// Recupera mensajes de sesión
if (isset($_SESSION['success_message'])) {
    $notification_message = $_SESSION['success_message'];
    $notification_type = 'success';
    unset($_SESSION['success_message']);
} 
elseif (isset($_SESSION['login_error'])) {
    $notification_message = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
} 
elseif (isset($_SESSION['register_error'])) {
    $notification_message = $_SESSION['register_error'];
    unset($_SESSION['register_error']);
}
?>

<!-- Genera notificación si existe mensaje -->
<?php if (!empty($notification_message)): ?>
<div id="popup-notification" class="popup-notification <?php echo $notification_type; ?>">
    <button class="close-btn" onclick="closePopup()">&times;</button>
    <?php echo htmlspecialchars($notification_message); ?>
</div>
<?php endif; ?>