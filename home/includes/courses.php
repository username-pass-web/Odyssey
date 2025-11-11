<?php 
/**
 * Muestra las áreas de práctica disponibles
 * 
 * Funcionalidades:
 * - Recupera áreas de estudio de la base de datos
 * - Genera tarjetas interactivas para cada área
 * - Escapa datos para prevenir XSS
 */

// Incluir archivo de conexión
include('../config/conex.php');

// Consultar todas las áreas disponibles
$course = mysqli_query($conex, "SELECT * FROM areas");

// Iterar sobre cada área y generar su tarjeta
while ($row = mysqli_fetch_array($course)) {

    // Escapar datos para prevenir XSS
    $components = htmlspecialchars($row['componentes']);
    $area = htmlspecialchars($row['areas']);
    $title = htmlspecialchars($row['titulo']);
    $description = htmlspecialchars($row['descripcion']);
    $image = htmlspecialchars($row['url_imagen']);
    ?>
    <div class="course-section">
        
        <!-- Botón que envía el área seleccionada al formulario -->
        <button type="submit" name="course" value="<?= $area ?>" class="course-card">
            <div class="course-card-container">
                <div class="course-info">
                    <p class="course-category"><?= $components ?></p>
                    <p class="course-title"><?= $title ?></p>
                    <p class="course-description"><?= $description ?></p>
                </div>
                <div class="course-image" style="background-image: url('<?= $image ?>');"></div>
            </div>
        </button>
    </div>
    <?php
}

// Cerrar conexión a la base de datos
mysqli_close($conex);
?>