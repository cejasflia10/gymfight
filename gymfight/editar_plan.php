<?php
include 'conexion.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$plan = $conexion->query("SELECT * FROM tipos_membresia WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'];
  $clases = (int)$_POST['clases'];
  $monto = (float)$_POST['monto'];

  $stmt = $conexion->prepare("UPDATE tipos_membresia SET nombre=?, clases=?, monto=? WHERE id=?");
  $stmt->bind_param("sidi", $nombre, $clases, $monto, $id);
  $stmt->execute();

  header("Location: planes.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Plan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container mt-5">
    <h2 class="text-warning">Editar Plan de Membresía</h2>
    <form method="POST" class="bg-secondary p-4 rounded">
      <div class="mb-3">
        <label class="form-label">Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($plan['nombre']) ?>" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Cantidad de Clases:</label>
        <input type="number" name="clases" value="<?= $plan['clases'] ?>" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Monto ($):</label>
        <input type="number" step="0.01" name="monto" value="<?= $plan['monto'] ?>" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-warning">Guardar Cambios</button>
      <a href="planes.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
</body>
</html>
