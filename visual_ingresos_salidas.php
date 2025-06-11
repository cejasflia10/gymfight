<?php
include 'conexion.php';
include 'menu.php';

$hoy = date('Y-m-d');
$result = $conexion->query("
    SELECT p.nombre, p.apellido, ip.fecha, ip.hora_entrada, ip.hora_salida
    FROM ingresos_profesores ip
    JOIN profesores p ON ip.profesor_id = p.id
    WHERE ip.fecha = '$hoy'
    ORDER BY ip.hora_entrada DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ingresos y Salidas Profesores</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #121212;
      color: #eee;
    }
    .container {
      margin-left: 260px;
      padding-top: 30px;
      max-width: 800px;
    }
    @media (max-width: 768px) {
      .container {
        margin-left: 0;
      }
    }
    h2 {
      color: #f0a500;
      margin-bottom: 20px;
      text-align: center;
    }
    .table {
      background-color: #1e1e1e;
    }
    .table th {
      background-color: #f0a500;
      color: #111;
    }
    .btn-volver {
      background-color: #f0a500;
      color: #111;
      font-weight: bold;
      border: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>📊 Ingresos y Salidas de Profesores Hoy (<?= date('d/m/Y') ?>)</h2>

    <?php if ($result->num_rows > 0): ?>
      <table class="table table-bordered table-hover text-center">
        <thead>
          <tr>
            <th>Profesor</th>
            <th>Fecha</th>
            <th>Entrada</th>
            <th>Salida</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['apellido'] . ', ' . $row['nombre']) ?></td>
            <td><?= date('d/m/Y', strtotime($row['fecha'])) ?></td>
            <td><?= $row['hora_entrada'] ?> hs</td>
            <td><?= $row['hora_salida'] ? $row['hora_salida'] . ' hs' : '---' ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="alert alert-warning text-center">No hay registros de hoy.</div>
    <?php endif; ?>

    <div class="text-center mt-4">
      <a href="index.php" class="btn btn-volver">⬅ Volver al Panel</a>
    </div>
  </div>
</body>
</html>
