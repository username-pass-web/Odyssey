<?php
/**
 * Lógica principal para el sistema de preguntas
 */

session_start();
include '../config/conex.php';

// Inicializar variables por defecto
$show_result = false;
$previous_result = [];

// Verificar respuestas solo si se envió una opción
if ($_POST && isset($_POST['opcion'])) {
    include 'processes/answerCheck.php';
}

// Cargar nueva pregunta solo si se solicitó explícitamente
if (isset($_POST['next_question']) || isset($_POST['reiniciar']) || isset($_POST['course']) || !isset($_SESSION['current_question_data'])) {
    include 'processes/questionQuery.php';
} else {
    // Mantener la pregunta actual si solo se está verificando la respuesta
    include 'processes/questionDisplay.php';
    
    //Verificar si se completó el cuestionario y actualizar racha
    $user_id = $_SESSION['id'];
    $answered_questions = $_SESSION['answered_questions'];
    $total_answered = count($answered_questions);
    
    // Si completó 5 preguntas, actualizar racha
    if ($total_answered >= 5) {
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
}

// Variables para los formularios
$option_values = ['A', 'B', 'C', 'D'];

// Clase CSS para el resultado
$result_class = '';
if ($show_result) {
    if ($previous_result['correct']) {
        $result_class = 'correct';
    } else {
        $result_class = 'incorrect';
    }
}

// Función para mostrar ícono del resultado
function generar_icono_resultado($correct) {
if ($correct) {
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>';
    } else {
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>';
    }
    return $icon;
}

// Función para mostrar título del resultado
function generar_titulo_resultado($correct) {
    if ($correct) {
        return '¡Respuesta Correcta!';
    } else {
        return 'Respuesta Incorrecta';
    }
}

// Función para mostrar puntos con signo
function formatear_puntos($points) {
    if ($points > 0) {
        return '+' . $points . ' Puntos';
    } else {
        return $points . ' Puntos';
    }
}
?>