<?php
/**
 * Página principal de preguntas del cuestionario
 */

include 'processes/questionsLogic.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odyssey - <?php echo $course_display_name; ?></title>
    <link rel="stylesheet" href="../home/dashboard.css">
    <link rel="stylesheet" href="questions.css">
    <script src="questions.js"></script>
</head>
<body>
    <div class="quiz-layout">
        <!-- Cabecera de la aplicación -->
        <header class="quiz-header">
            <div class="quiz-header-left">
                <div class="logo-icon">
                    <img src="../img/logo.svg" alt="Logo Odyssey" width="20" height="20">
                </div>
                <h2 class="quiz-header-title">Odyssey - <?php echo $course_display_name; ?></h2>
            </div>
            <div class="quiz-header-right">
                <nav class="quiz-nav">
                    <a class="quiz-nav-link" href="../home/dashboard.php">Dashboard</a>
                    <a class="quiz-nav-link" href="#">Cursos</a>
                    <a class="quiz-nav-link" href="#">Recursos</a>
                </nav>
                <a href="../includes/logout.php" class="quiz-header-btn">
                    <img src="../img/logout.svg" width="20" height="20" alt="Cerrar sesión">
                </a>
            </div>
        </header>

        <!-- Contenido principal -->
        <main class="quiz-main">
            <div class="quiz-content">
                <div class="quiz-section-header">
                    <h1 class="quiz-section-title"><?php echo $course_display_name; ?></h1>
                </div>

                <div class="quiz-wrapper">
                    <div class="quiz-main-content">
                        
                        <!-- Si el cuestionario no está completado Y la pregunta se cargó -->
                        <?php if (!$quiz_completed && $question_loaded): ?>
                        <form action="questions.php" method="POST">
                            <h2 class="quiz-question-header"><?php echo $header; ?></h2>
                            
                            <!-- Mostrar párrafo solo si existe -->
                            <?php if (!empty($paragraph)): ?>
                            <div class="quiz-context">
                                <p class="quiz-text"><?php echo htmlspecialchars($paragraph); ?></p>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Texto de la pregunta -->
                            <p class="quiz-question-text"><?php echo $question; ?></p>
                            
                            <!-- Mostrar todas las opciones A, B, C, D -->
                            <div class="quiz-options">
                                <?php 
                                $option_count = count($options);
                                for ($i = 0; $i < $option_count; $i++): 
                                ?>
                                <label>
                                    <input type="radio" name="opcion" value="<?php echo $option_values[$i]; ?>" 
                                           <?php echo (isset($_SESSION['question_answered']) && $_SESSION['question_answered']) ? 'disabled' : 'required'; ?>>
                                    <div class="quiz-option">
                                        <div class="quiz-option-radio"></div>
                                        <p class="quiz-text"><?php echo trim($options[$i]); ?></p>
                                    </div>
                                </label>
                                <?php endfor; ?>
                            </div>
                            
                            <!-- Botones de acción -->
                            <div class="quiz-actions">
                                <?php if (isset($_SESSION['question_answered']) && $_SESSION['question_answered']): ?>
                                    <button type="submit" name="next_question" class="btn btn-primary">Siguiente pregunta</button>
                                <?php else: ?>
                                    <button type="submit" class="btn btn-primary">Responder</button>
                                <?php endif; ?>
                                <a href="../home/dashboard.php" class="btn btn-outline">Volver al Dashboard</a>
                            </div>
                        </form>
                        
                        <!-- Si el cuestionario está completado -->
                        <?php else: ?>
                        <div class="quiz-completion">
                            <h2 class="quiz-section-title">¡<?php echo $course_display_name; ?> Completado!</h2>
                            <p class="quiz-completion-text">
                                Has terminado todas las preguntas de hoy. <br> 
                                ¡Felicidades por completar este desafío! 
                            </p>
                            <form action="questions.php" method="POST" class="quiz-actions">
                                <button name="reiniciar" type="submit" class="btn btn-primary">
                                    Reiniciar <?php echo $course_display_name; ?>
                                </button>
                                <a href="../home/dashboard.php" class="btn btn-outline">Volver al Dashboard</a>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Barra lateral con información -->
                    <aside class="quiz-sidebar">
                        
                        <!-- Tarjeta de progreso -->
                        <div class="quiz-stats">
                            <h3 class="quiz-stats-title">Progreso de <?php echo $course_display_name; ?></h3>
                            <div class="quiz-stats-value"><?php echo $progress_value; ?>/5</div>
                            <div class="quiz-progress">
                                <div class="quiz-progress-fill" style="width: <?php echo $progress_width; ?>%"></div>
                            </div>
                        </div>
                        
                        <!-- Mostrar resultado solo si hay resultado -->
                        <?php if ($show_result): ?>
                        <div class="quiz-result <?php echo 'quiz-result-' . $result_class; ?>">
                            <div class="quiz-result-header">
                                <div class="quiz-result-icon">
                                    <?php echo generar_icono_resultado($previous_result['correct']); ?>
                                </div>
                                <h3 class="quiz-result-title"><?php echo generar_titulo_resultado($previous_result['correct']); ?></h3>
                            </div>
                            
                            <!-- Mostrar comparación solo si la respuesta fue incorrecta -->
                            <?php if (!$previous_result['correct']): ?>
                            <div class="quiz-result-comparison">
                                <p><strong>Tu respuesta:</strong> <?php echo htmlspecialchars($previous_result['user_answer']); ?></p>
                                <p><strong>Respuesta correcta:</strong> <?php echo htmlspecialchars($previous_result['correct_answer']); ?></p>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Explicación de la respuesta -->
                            <div class="quiz-explanation">
                                <p><strong>Explicación:</strong></p>
                                <p class="quiz-explanation-text"><?php echo htmlspecialchars($previous_result['explanation']); ?></p>
                            </div>
                        </div>

                        <!-- Tarjeta de puntos obtenidos -->
                        <div class="quiz-points <?php echo $result_class; ?>">
                            <strong><?php echo formatear_puntos($previous_result['points_change']); ?></strong>
                        </div>
                        <?php endif; ?>
                    </aside>
                </div>
            </div>
        </main>
    </div>
    
</body>
</html>