<?php
/**
 * Verificación de respuestas del cuestionario
 */

$show_result = false;
$previous_result = [];

// Si el usuario envió una respuesta
if ($_POST && isset($_POST['opcion'])) {
    
    $course = $_SESSION['course'];
    $previous_question_id = $_SESSION['last_question_id'];
    $user_option_letter = $_POST['opcion'];
    $user_id = $_SESSION['id'];

    // Buscar la pregunta anterior en la base de datos
    $query = "SELECT pregunta, respuestas, respuestaCorrecta, explicacion FROM $course WHERE id = '$previous_question_id'";
    $result = mysqli_query($conex, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Verificar si la respuesta es correcta
        $is_correct = false;
        if ($row['respuestaCorrecta'] == $user_option_letter) {
            $is_correct = true;
        }

        // Separar las opciones A, B, C, D
        $options_array = preg_split('/(?=[A-D]\.)/', $row['respuestas'], -1, PREG_SPLIT_NO_EMPTY);
        
        // Convertir letras en números para el array
        $options_map = ['A' => 0, 'B' => 1, 'C' => 2, 'D' => 3];

        // Obtener texto de la respuesta del usuario
        $user_answer_text = '';
        $user_option_index = $options_map[$user_option_letter];
        if (isset($options_array[$user_option_index])) {
            $user_answer_text = trim($options_array[$user_option_index]);
        }

        // Obtener texto de la respuesta correcta
        $correct_letter = $row['respuestaCorrecta'];
        $correct_option_index = $options_map[$correct_letter];
        
        if (isset($options_array[$correct_option_index])) {
            $correct_answer_text = trim($options_array[$correct_option_index]);
        }

        // Calcular puntos a sumar o restar
        $points_change = 0;
        if ($is_correct) {
            $points_change = 25;
        } else {
            $points_change = -10;
        }
        
        // Actualizar puntaje en la base de datos
        $update_query = "UPDATE usuarios_datos SET puntaje = puntaje + $points_change WHERE id_usuario = $user_id";
        mysqli_query($conex, $update_query);

        // Guardar datos para mostrar resultado
        $previous_result = [
            'correct' => $is_correct,
            'correct_answer' => $correct_answer_text,
            'user_answer' => $user_answer_text,
            'explanation' => $row['explicacion'],
            'points_change' => $points_change
        ];
        
        $show_result = true;
        
        // Marcar que la pregunta ha sido respondida
        $_SESSION['question_answered'] = true;
    }
}
?>