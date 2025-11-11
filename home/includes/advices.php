<?php
/**
 * Muestra consejos para pruebas Saber
 * 
 * Funcionalidades:
 * - Recupera consejos de la base de datos
 * - Genera tarjetas de consejos con formato consistente
 */

// Incluir archivo de conexión
include('../config/conex.php');

// Consultar todos los consejos disponibles
$advices = mysqli_query($conex, "SELECT * FROM advices");

// Iterar sobre cada consejo y generar su tarjeta
while ($row = mysqli_fetch_array($advices)) {
    $id_advice = htmlspecialchars($row['id_consejo']);
    $title = htmlspecialchars($row['titulo']);
    $description = htmlspecialchars($row['descripcion']);
    ?>
    <div class="advice-item">
        <div class="course-info">
            <p class="advice-id">Consejo <?= $id_advice ?></p>
            <p class="advice-title"><?= $title ?></p>
            <p class="advice-description"><?= $description ?></p>
        </div>
    </div>
    <?php
}

// Cerrar conexión a la base de datos
mysqli_close($conex);
?>