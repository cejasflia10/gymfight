<?php
include 'conexion.php';
include 'menu.php';

date_default_timezone_set('America/Argentina/Buenos_Aires');
$mes_actual = date('Y-m');
$valor_por_hora = 2500;

$sql = "
  SELECT p.id, p.nombre, p.apellido,
    SUM(TIMESTAMPDIFF(MINUTE, ip.hora_entrada, ip.hora_salida)) AS minutos_totales
  FROM profesores p
  LEFT JOIN ingresos_profesores ip
    ON p.id = ip.profesor_id
    AND DATE_FORMAT(ip.fecha, '%Y-%m') = ?
    AND ip.hora_entrada IS NOT NULL AND ip.hora_salida IS NOT NULL
  GROUP BY p.id
  ORDER BY p.apellido, p.nombre
";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $mes_actual);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Horas Trabajadas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container { margin-left: 260px; padding: 30px 15px; }
    h2 { margin-bottom: 20px; color: #333; }
  </style>
</head>
<body class="bg-light">
<div class="container">
  <h2>Horas Trabajadas por Profesores (<?= date('F Y') ?>)</h2>

  <table class="table table-bordered table-striped bg-white shadow-sm">
    <thead class="table-dark">
      <tr>
        <th>Profesor</th>
        <th>Horas Totales</th>
        <th>Valor x Hora</th>
        <th>Total a Pagar</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $resultado->fetch_assoc()): 
        $min = $row['minutos_totales'] ?? 0;
        $horas = round($min / 60, 2);
        $total = round($horas * $valor_por_hora, 2);
      ?>
      <tr>
        <td><?= htmlspecialchars($row['apellido'] . ', ' . $row['nombre']) ?></td>
        <td><?= $horas ?></td>
        <td>$<?= number_format($valor_por_hora, 2) ?></td>
        <td>$<?= number_format($total, 2) ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <a href="index.php" class="btn btn-secondary mt-3">Volver al inicio</a>
</div>
</body>
</html>
