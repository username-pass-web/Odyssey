<?php
/**
 * Página principal del dashboard
 * 
 * Funcionalidades:
 * - Muestra la interfaz principal después del login
 * - Incluye sistema de pestañas para alternar entre áreas de práctica y consejos
 * - Integra perfil de usuario con estadísticas
 * - Diseño responsive con sidebar y contenido principal
 */
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración básica -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Odyssey</title>

    <!-- Estilos principales -->
    <link rel="stylesheet" href="dashboard.css">


    <script src="dashboard.js" defer></script>
</head>
<body>
    <div class="layout-container">

        <!-- Encabezado con logo y navegación -->
        <header class="header">
            <div class="header-left">
                <div class="logo-icon">
                    <img src="../img/logo.svg" alt="Logo Odyssey">
                </div>
                <h2 class="header-title">Odyssey - Viaje de Aprendizaje</h2>
            </div>
            <div class="header-right">

                <!-- Menú de navegación principal -->
                <nav class="nav-links">
                    <a class="nav-link" href="#">Cursos</a>
                    <a class="nav-link" href="#">Consejos</a>
                    <a class="nav-link" href="#">Recursos</a>
                </nav>

                <!-- Botón de cierre de sesión -->
                <a href="includes/logout.php" class="header-btn">
                    <img src="../img/logout.svg" width="20" height="20" alt="Cerrar sesión">
                </a>
            </div>
        </header>

        <!-- Contenido principal - Dividido en sección central y sidebar -->
        <div class="main-content">

            <!-- Sección de contenido -->
            <div class="content-container"
            >
                <!-- Título principal del dashboard -->
                <div class="dashboard-header">
                    <h1 class="dashboard-title">Dashboard</h1>
                </div>

                <!-- Sistema de pestañas para alternar contenido -->
                <div class="tabs-content-wrapper">
                    
                    <!-- Selector de pestañas -->
                    <div class="tabs-header">
                        <button class="tab active" data-target="courses">
                            <p>Areas para practicar</p>
                        </button>
                        <button class="tab" data-target="advice">
                            <p>Consejos para la prueba saber</p>
                        </button>
                    </div>

                    <!-- Contenido de áreas de práctica (activo por defecto) -->
                    <div id="courses" class="section-content active">
                        <form action="../questions/questions.php" method="POST">
                            <?php include 'includes/courses.php'; ?>
                        </form>
                    </div>

                    <!-- Contenido de consejos -->
                    <div id="advice" class="section-content">
                        <div class="advice-container">
                            <?php include 'includes/advices.php'; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar con perfil y estadísticas -->
            <div class="sidebar">
                <?php include 'includes/profile.php' ?>
            </div>
        </div>
    </div>
</body>
</html>