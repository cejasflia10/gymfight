<?php
include 'conexion.php';

$consulta = $conexion->query("
  SELECT p.id, p.nombre, p.apellido, 
    SEC_TO_TIME(SUM(TIMESTAMPDIFF(SECOND, i.hora_entrada, i.hora_salida))) AS total_tiempo,
    ROUND(SUM(TIMESTAMPDIFF(SECOND, i.hora_entrada, i.hora_salida)) / 3600 * 2500, 2) AS total_pagar
  FROM ingresos_profesores i
  JOIN profesores p ON i.profesor_id = p.id
  WHERE i.hora_entrada IS NOT NULL AND i.hora_salida IS NOT NULL
    AND MONTH(i.hora_entrada) = MONTH(CURRENT_DATE())
    AND YEAR(i.hora_entrada) = YEAR(CURRENT_DATE())
  GROUP BY p.id
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Horas Profesores</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-4">
  <h2 class="text-center mb-4">Horas Trabajadas - Profesores (Mes Actual)</h2>
  <table class="table table-bordered table-striped bg-white shadow-sm">
    <thead class="table-dark">
      <tr>
        <th>Profesor</th>
        <th>Horas Totales</th>
        <th>Total a Pagar ($)</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $consulta->fetch_assoc()): ?>
        <tr>
          <td><?= $row['apellido'] . ', ' . $row['nombre'] ?></td>
          <td><?= $row['total_tiempo'] ?></td>
          <td>$<?= number_format($row['total_pagar'], 2) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
