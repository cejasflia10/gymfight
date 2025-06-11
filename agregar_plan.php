<?php
include 'conexion.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = trim($_POST['nombre']);
  $clases = (int)$_POST['clases'];
  $monto = (float)$_POST['monto'];

  if ($nombre && $clases >= 0 && $monto >= 0) {
    $stmt = $conexion->prepare("INSERT INTO tipos_membresia (nombre, clases, monto) VALUES (?, ?, ?)");
    $stmt->bind_param("sid", $nombre, $clases, $monto);
    if ($stmt->execute()) {
      $mensaje = "✅ Plan agregado correctamente.";
    } else {
      $mensaje = "❌ Error al agregar el plan.";
    }
  } else {
    $mensaje = "❌ Complete todos los campos correctamente.";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Plan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #f1f1f1;
    }
    .container {
      margin-left: 250px;
      padding: 20px;
      max-width: 600px;
    }
    h2 {
      color: #ffc107;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Agregar Plan de Membresía</h2>

    <?php if ($mensaje): ?>
      <div class="alert alert-info"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-dark p-4 rounded border">
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del Plan:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required maxlength="100">
      </div>
      <div class="mb-3">
        <label for="clases" class="form-label">Cantidad de Clases:</label>
        <input type="number" name="clases" id="clases" class="form-control" min="0" required>
      </div>
      <div class="mb-3">
        <label for="monto" class="form-label">Monto ($):</label>
        <input type="number" step="0.01" name="monto" id="monto" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success">Guardar Plan</button>
      <a href="planes.php" class="btn btn-secondary">Volver</a>
    </form>
  </div>
</body>
</html>
