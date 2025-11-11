<?php
/**
 * Página de inicio de sesión
 * 
 * Incluye:
 * - Manejo de mensajes de error
 * - Formulario de login con campos: email y contraseña
 * - Diseño responsive con imagen decorativa
 * - Enlaces para registro y recuperación de contraseña
 */
?>
<!-- Mensaje de error/éxito -->
<?php include 'processes/message.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Configuración básica -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Odyssey</title>

    <!-- Estilos principales -->
    <link rel="stylesheet" href="login.css">

    <!-- Script de notificaciones -->
    <script src="processes/message.js"></script>
</head>

<body>
    <div class="design-root">
        <div class="layout-container">

            <!-- Encabezado -->
            <header class="header">
                <div class="header-content">
                    <div class="logo-icon">
                        <img src="../img/logo.svg" alt="Logo Odyssey">
                    </div>
                    <h2 class="header-title">Odyssey - Viaje de aprendizaje</h2>
                </div>
            </header>

            <!-- Contenido principal -->
            <div class="main-content">

                <!-- Sección de imagen decorativa -->
                <div class="img-section">
                    <div class="img-container">
                        <div class="img-image"></div>
                    </div>
                </div>

                <!-- Sección de formulario de login -->
                <div class="login-section">
                    <h2 class="welcome-title">Bienvenido de nuevo</h2>

                    <form action="processes/send_login.php" method="POST" class="login-form">

                        <!-- Campo: Email -->
                        <div class="form-group">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="email" placeholder="Ingresa tu correo electrónico"
                                class="form-input" required />
                        </div>

                        <!-- Campo: Contraseña -->
                        <div class="form-group">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" placeholder="Ingresa tu contraseña"
                                class="form-input" required />
                        </div>

                        <!-- Enlace de recuperación -->
                        <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>

                        <!-- Botón de envío -->
                        <button type="submit" class="login-button">
                            <span>Iniciar sesión</span>
                        </button>

                        <!-- Enlace alternativo a registro -->
                        <p class="register-link">
                            ¿No tienes una cuenta? <a href="register.php">Regístrate</a>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>