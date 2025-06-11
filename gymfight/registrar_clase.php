<?php
include 'conexion.php';

$mensaje = "";

// Obtener la lista de profesores para el selector
$result_profesores = $conexion->query("SELECT id, nombre FROM profesores ORDER BY nombre");

// Obtener la lista de días para el selector
$dias_semana = [
    'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'
];

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_clase'])) {
    $profesor_id = intval($_POST['profesor_id']);
    $dia = $_POST['dia'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];

    // Validaciones básicas
    if (!$profesor_id || !in_array($dia, $dias_semana) || !$hora_inicio || !$hora_fin) {
        $mensaje = "❌ Por favor complete todos los campos correctamente.";
    } else {
        $stmt = $conexion->prepare("INSERT INTO clases (profesor_id, dia, hora_inicio, hora_fin) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $profesor_id, $dia, $hora_inicio, $hora_fin);
        if ($stmt->execute()) {
            $mensaje = "✅ Clase registrada correctamente.";
        } else {
            $mensaje = "❌ Error al registrar clase: " . $conexion->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Registrar Clase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="container py-4">
    <h2 class="mb-4 text-center">Registrar Nueva Clase</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-info text-center"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 500px;">
        <div class="mb-3">
            <label for="profesor_id" class="form-label">Profesor:</label>
            <select name="profesor_id" id="profesor_id" class="form-select" required>
                <option value="">Seleccione un profesor</option>
                <?php while ($profesor = $result_profesores->fetch_assoc()): ?>
                    <option value="<?= $profesor['id'] ?>"><?= htmlspecialchars($profesor['nombre']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="dia" class="form-label">Día:</label>
            <select name="dia" id="dia" class="form-select" required>
                <option value="">Seleccione un día</option>
                <?php foreach ($dias_semana as $d): ?>
                    <option value="<?= $d ?>"><?= $d ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="hora_inicio" class="form-label">Hora Inicio:</label>
            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="hora_fin" class="form-label">Hora Fin:</label>
            <input type="time" name="hora_fin" id="hora_fin" class="form-control" required>
        </div>

        <button type="submit" name="registrar_clase" class="btn btn-primary w-100">Registrar Clase</button>
    </form>
</div>
</body>
</html>
