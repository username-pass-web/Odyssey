/**
 * Controlador de notificaciones
 * 
 * Funcionalidades:
 * - Muestra notificaciones emergentes
 * - Cierre automático después de 5 segundos
 * - Animaciones de entrada/salida
 */

// Muestra notificación con animación
function showPopup() {
    const popup = document.getElementById('popup-notification');
    if (popup) {
        setTimeout(() => {
            popup.classList.add('show');
        }, 100);
        
        // Cierre automático
        setTimeout(() => {
            closePopup();
        }, 5000);
    }
}

// Cierra notificación con animación
function closePopup() {
    const popup = document.getElementById('popup-notification');
    if (popup) {
        popup.classList.remove('show');
        setTimeout(() => {
            popup.remove();
        }, 300);
    }
}

// Inicialización al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('popup-notification');
    if (popup) {
        showPopup();
    }
});