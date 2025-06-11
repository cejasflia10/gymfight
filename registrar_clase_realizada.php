<?php
include 'conexion.php';
include 'menu.php';

$mensaje = "";

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $profesor_id = $_POST['profesor_id'];
    $fecha = $_POST['fecha'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];

    if ($profesor_id && $fecha && $hora_inicio && $hora_fin) {
        $stmt = $conexion->prepare("INSERT INTO clases_realizadas (profesor_id, fecha, hora_inicio, hora_fin) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $profesor_id, $fecha, $hora_inicio, $hora_fin);

        if ($stmt->execute()) {
            $mensaje = "✅ Clase registrada correctamente.";
        } else {
            $mensaje = "❌ Error al registrar la clase.";
        }
    } else {
        $mensaje = "❌ Por favor complete todos los campos.";
    }
}

// Obtener profesores
$profesores = $conexion->query("SELECT id, nombre FROM profesores ORDER BY nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Clase Realizada</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container { margin-left: 260px; padding-top: 30px; }
    @media (max-width: 768px) {
      .container { margin-left: 0; }
    }
  </style>
</head>
<body class="bg-light">

<div class="container">
  <h2 class="mb-4 text-center">Registrar Clase Realizada</h2>

  <?php if ($mensaje): ?>
    <div class="alert alert-info text-center"><?= $mensaje ?></div>
  <?php endif; ?>

  <form method="POST" class="bg-white p-4 rounded shadow-sm">
    <div class="mb-3">
      <label for="profesor_id" class="form-label">Profesor:</label>
      <select name="profesor_id" id="profesor_id" class="form-select" required>
        <option value="">Seleccionar...</option>
        <?php while ($prof = $profesores->fetch_assoc()): ?>
          <option value="<?= $prof['id'] ?>"><?= $prof['nombre'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="fecha" class="form-label">Fecha:</label>
      <input type="date" name="fecha" id="fecha" class="form-control" required value="<?= date('Y-m-d') ?>">
    </div>

    <div class="mb-3">
      <label for="hora_inicio" class="form-label">Hora de Inicio:</label>
      <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="hora_fin" class="form-label">Hora de Fin:</label>
      <input type="time" name="hora_fin" id="hora_fin" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Registrar Clase</button>
    <a href="index.php" class="btn btn-secondary">Volver</a>
  </form>
</div>

</body>
</html>
