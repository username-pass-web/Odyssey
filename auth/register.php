<?php
/**
 * Página de registro de usuarios
 * 
 * Incluye:
 * - Manejo de mensajes de error/éxito
 * - Formulario de registro con campos: usuario, email, contraseña y confirmación
 * - Diseño responsive con imagen decorativa
 * - Notificaciones emergentes para mensajes del sistema
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
    <title>Registro - Odyssey</title>

    <!-- Estilos principales -->
    <link rel="stylesheet" href="register.css">

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
                        <div class="img-bg"></div>
                    </div>
                </div>

                <!-- Sección de formulario de registro -->
                <div class="register-section">
                    <h2 class="register-title">Registrarse</h2>

                    <form action="processes/send_register.php" method="POST" class="register-form">

                        <!-- Campo: Nombre de usuario -->
                        <div class="form-group">
                            <label class="form-label">Usuario</label>
                            <input type="text" name="username" placeholder="Ingresa tu nombre de usuario"
                                class="form-input" required />
                        </div>

                        <!-- Campo: Email -->
                        <div class="form-group">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="email" placeholder="Ingresa tu correo electrónico"
                                class="form-input" required />
                        </div>

                        <!-- Campo: Contraseña -->
                        <div class="form-group">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" placeholder="Crea una contraseña segura"
                                class="form-input" required />
                        </div>

                        <!-- Campo: Confirmar contraseña -->
                        <div class="form-group">
                            <label class="form-label">Confirmar contraseña</label>
                            <input type="password" name="confirm_password" placeholder="Vuelve a escribir tu contraseña"
                                class="form-input" required />
                        </div>

                        <!-- Botón de envío -->
                        <div class="button-container">
                            <button type="submit" class="register-button">
                                <span>Crear cuenta</span>
                            </button>
                        </div>

                        <!-- Enlace alternativo a login -->
                        <p class="login-link">
                            ¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>