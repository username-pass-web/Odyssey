<?php
/**
 * Mostrar pregunta actual sin generar nueva
 */

$user_id = $_SESSION['id'];

// Inicializar variables si no están definidas
if (!isset($show_result)) {
    $show_result = false;
}
if (!isset($previous_result)) {
    $previous_result = [];
}

// Usar datos de la pregunta actual almacenados en sesión
if (isset($_SESSION['current_question_data'])) {
    $current_question_data = $_SESSION['current_question_data'];
    
    $course = $_SESSION['course'];
    $course_display_name = ucfirst(str_replace('_', ' ', $course));
    $answered_questions = $_SESSION['answered_questions'];
    
    // Variables para la pregunta actual
    $current_question_id = $current_question_data['id'];
    $question_loaded = true;
    
    // Verificar si ya respondió 5 preguntas
    $total_answered = count($answered_questions);
    $quiz_completed = false;
    if ($total_answered >= 5) {
        $quiz_completed = true;
    }
    
    // Variables para mostrar en pantalla
    if (!$quiz_completed) {
        $header = "Pregunta " . $total_answered . " de 5";
        $question = $current_question_data['pregunta'];
        $paragraph = $current_question_data['parrafo'];
        $options = $current_question_data['options'];
    }
    
    // Calcular progreso
    $progress_value = 0;
    if ($quiz_completed) {
        $progress_value = 5;
    } else {
        $progress_value = $total_answered - 1;
        if ($progress_value < 0) $progress_value = 0;
    }
    $progress_width = ($progress_value / 5) * 100;
    
} else {
    // Si no hay datos de pregunta actual, redirigir a generar nueva
    include 'processes/questionQuery.php';
}
?>