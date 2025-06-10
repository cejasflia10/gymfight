<?php
include 'conexion.php';
$hoy = date('Y-m-d');
$inicioMes = date('Y-m-01');

// Ingresos del día
$ingresos_dia = $conexion->query("
    SELECT c.nombre, c.apellido, a.fecha_hora, m.clases_restantes 
    FROM asistencias a
    JOIN membresias m ON a.membresia_id = m.id
    JOIN clientes c ON m.cliente_id = c.id
    WHERE DATE(a.fecha_hora) = '$hoy'
    ORDER BY a.fecha_hora DESC
");

// Ingresos del mes
$ingresos_mes = $conexion->query("
    SELECT c.nombre, c.apellido, a.fecha_hora, m.clases_restantes 
    FROM asistencias a
    JOIN membresias m ON a.membresia_id = m.id
    JOIN clientes c ON m.cliente_id = c.id
    WHERE DATE(a.fecha_hora) BETWEEN '$inicioMes' AND '$hoy'
    ORDER BY a.fecha_hora DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ingresos de Clientes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #111;
      color: #f0f0f0;
      font-family: Arial, sans-serif;
    }
    .container {
      max-width: 1000px;
      margin: 50px auto;
      background: #222;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px #000;
    }
    h2 {
      color: #ffc107;
    }
    table {
      margin-top: 20px;
    }
    th {
      background: #ffc107;
      color: #000;
    }
    td {
      background: #333;
    }
    .btn-volver {
      margin-top: 20px;
      background: #ffc107;
      color: #000;
      border: none;
    }
    .btn-volver:hover {
      background: #e0a800;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="text-center">Ingresos del Día - <?= date('d/m/Y') ?></h2>
    <table class="table table-bordered table-hover text-white">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Fecha y Hora</th>
          <th>Clases Restantes</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $ingresos_dia->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['nombre']) ?></td>
            <td><?= htmlspecialchars($row['apellido']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($row['fecha_hora'])) ?></td>
            <td><?= $row['clases_restantes'] ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <h2 class="text-center mt-5">Ingresos del Mes</h2>
    <table class="table table-bordered table-hover text-white">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Fecha y Hora</th>
          <th>Clases Restantes</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $ingresos_mes->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['nombre']) ?></td>
            <td><?= htmlspecialchars($row['apellido']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($row['fecha_hora'])) ?></td>
            <td><?= $row['clases_restantes'] ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <a href="index.php" class="btn btn-volver">Volver al Menú</a>
  </div>
</body>
</html>
