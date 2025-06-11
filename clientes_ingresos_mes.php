<?php
include 'conexion.php';
include 'menu.php';

$hoy = date('Y-m');
$query = "
    SELECT c.nombre, c.apellido, a.fecha_hora, m.clases_restantes
    FROM asistencias a
    JOIN clientes c ON a.cliente_id = c.id
    JOIN membresias m ON a.membresia_id = m.id
    WHERE a.tipo = 'cliente' AND DATE_FORMAT(a.fecha_hora, '%Y-%m') = ?
    ORDER BY a.fecha_hora DESC
";

$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $hoy);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Entradas del Mes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #f0a500;
    }
    .container {
      margin-left: 260px;
      padding-top: 40px;
    }
    h2 {
      color: #f0a500;
    }
    .table {
      background-color: #1e1e1e;
      color: #fff;
    }
    .table thead {
      background-color: #f0a500;
      color: #121212;
    }
    .btn-volver {
      background-color: #f0a500;
      color: #121212;
      border: none;
    }
  </style>
</head>
<body>
<div class="container">
  <h2 class="text-center mb-4">📆 Ingresos de Clientes - Mes Actual</h2>

  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Cliente</th>
        <th>Fecha y Hora</th>
        <th>Clases Restantes</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['nombre'] . ' ' . $row['apellido']) ?></td>
            <td><?= $row['fecha_hora'] ?></td>
            <td><?= $row['clases_restantes'] ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="3" class="text-center">No se registraron ingresos este mes.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <a href="index.php" class="btn btn-volver">🔙 Volver al Panel</a>
</div>
</body>
</html>
