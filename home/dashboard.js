/**
 * Controlador del dashboard
 * 
 * Funcionalidades:
 * - Maneja el sistema de pestañas
 * - Controla la visualización de contenido por secciones
 * - Proporciona interacción de usuario
 */

document.addEventListener('DOMContentLoaded', function() {
    // Cambio entre pestañas
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remover clase activa de todas las pestañas
            tabs.forEach(t => t.classList.remove('active'));
            
            // Añadir clase activa a la pestaña actual
            this.classList.add('active');
            
            // Ocultar todo el contenido
            document.querySelectorAll('.section-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Mostrar contenido correspondiente
            const targetId = this.dataset.target;
            document.getElementById(targetId).classList.add('active');
        });
    });
});