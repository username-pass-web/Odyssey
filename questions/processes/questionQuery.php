<?php
/**
 * Consulta y manejo de preguntas del cuestionario
 */

$user_id = $_SESSION['id'];

// Inicializar variables si no están definidas
if (!isset($show_result)) {
    $show_result = false;
}
if (!isset($previous_result)) {
    $previous_result = [];
}

// Si seleccionó nueva materia o reiniciar
if (isset($_POST['course']) || isset($_POST['reiniciar'])) {
    if (isset($_POST['course'])) {
        $_SESSION['course'] = $_POST['course'];
    }
    $_SESSION['answered_questions'] = [];
    $show_result = false;
    // Limpiar datos de pregunta actual
    unset($_SESSION['current_question_data']);
    unset($_SESSION['question_answered']);
}

// Configurar valores iniciales
if (!isset($_SESSION['course'])) {
    $_SESSION['course'] = 'matematicas';
}
if (!isset($_SESSION['answered_questions'])) {
    $_SESSION['answered_questions'] = [];
}

$course = $_SESSION['course'];
$course_display_name = ucfirst(str_replace('_', ' ', $course));
$answered_questions = $_SESSION['answered_questions'];

// Variables para la pregunta actual
$current_question_id = null;
$question_loaded = false;

// Verificar si ya respondió 5 preguntas
$total_answered = count($answered_questions);
$quiz_completed = false;
if ($total_answered >= 5) {
    $quiz_completed = true;
}

// Si no terminó, buscar nueva pregunta
if (!$quiz_completed) {
    
    // Buscar IDs disponibles
    $query_ids = "SELECT id FROM $course";
    
    // Excluir preguntas ya respondidas
    if (!empty($answered_questions)) {
        $exclude_ids_str = implode(',', array_map('intval', $answered_questions));
        $query_ids = $query_ids . " WHERE id NOT IN ($exclude_ids_str)";
    }
    
    // Ordenar aleatoriamente
    $query_ids = $query_ids . " ORDER BY RAND() LIMIT 1";
    
    $result_id = mysqli_query($conex, $query_ids);
    if ($result_id && $row_id = mysqli_fetch_assoc($result_id)) {
        $current_question_id = $row_id['id'];
        $_SESSION['last_question_id'] = $current_question_id;
        $_SESSION['answered_questions'][] = $current_question_id;
    } else {
        $quiz_completed = true;
    }
}

// Variables para mostrar en pantalla
$header = "Pregunta " . count($_SESSION['answered_questions']) . " de 5";
$question = "Cargando pregunta...";
$paragraph = "";
$options = [];

// Cargar datos de la pregunta actual
if ($current_question_id !== null) {
    
    $query = "SELECT parrafo, pregunta, respuestas FROM $course WHERE id = '$current_question_id'";
    $result = mysqli_query($conex, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $paragraph = $row['parrafo'];
        $question = $row['pregunta'];
        
        // Separar opciones A, B, C, D
        $options = preg_split('/(?=[A-D]\.)/', $row['respuestas'], -1, PREG_SPLIT_NO_EMPTY);
        $question_loaded = true;
        
        // Guardar datos de la pregunta en sesión
        $_SESSION['current_question_data'] = [
            'id' => $current_question_id,
            'parrafo' => $paragraph,
            'pregunta' => $question,
            'options' => $options
        ];
        
        // Limpiar estado de pregunta respondida
        unset($_SESSION['question_answered']);
    }
}

// Actualizar racha si terminó cuestionario
if ($quiz_completed) {
    
    $query_streak = "SELECT ultima_sesion FROM usuarios_datos WHERE id_usuario = '$user_id'";
    $result_streak = mysqli_query($conex, $query_streak);
    
    if ($result_streak) {
        $user_data = mysqli_fetch_assoc($result_streak);
        $today = date('Y-m-d');
        
        // Si es un día nuevo, aumentar racha
        $is_new_day = false;
        if (!$user_data || $user_data['ultima_sesion'] < $today) {
            $is_new_day = true;
        }
        
        if ($is_new_day) {
            $update_streak_query = "UPDATE usuarios_datos SET racha = racha + 1, ultima_sesion = '$today' WHERE id_usuario = '$user_id'";
            mysqli_query($conex, $update_streak_query);
        }
    }
}

// Calcular progreso
$progress_value = 0;
if ($quiz_completed) {
    $progress_value = 5;
} else {
    $progress_value = count($_SESSION['answered_questions']) - 1;
}
$progress_width = ($progress_value / 5) * 100;
?>