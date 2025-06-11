<?php
include 'conexion.php';
include 'menu.php';

date_default_timezone_set('America/Argentina/Buenos_Aires');
$mes_actual = date('Y-m');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Clientes - Asistencias del Mes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container {
      margin-left: 260px;
      padding: 30px 15px;
    }
    h2 {
      margin-bottom: 20px;
      color: #333;
    }
    .activo { color: green; font-weight: bold; }
    .vencido { color: red; font-weight: bold; }
    .sin-clases { color: orange; font-weight: bold; }
  </style>
</head>
<body class="bg-light">
  <div class="container">
    <h2>Reporte de Asistencias de Clientes (<?= date('F Y') ?>)</h2>

    <table class="table table-bordered table-striped bg-white shadow-sm">
      <thead class="table-dark">
        <tr>
          <th>Nombre</th>
          <th>DNI</th>
          <th>Clases Restantes</th>
          <th>Asistencias en el Mes</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "
          SELECT c.nombre, c.apellido, c.dni, m.clases_restantes, m.fecha_vencimiento,
            COUNT(a.id) AS asistencias_mes
          FROM clientes c
          JOIN membresias m ON m.cliente_id = c.id
          LEFT JOIN asistencias a ON a.cliente_id = c.id AND DATE_FORMAT(a.fecha_hora, '%Y-%m') = ?
          GROUP BY c.id
          ORDER BY c.apellido, c.nombre
        ";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $mes_actual);
        $stmt->execute();
        $resultado = $stmt->get_result();

        while ($row = $resultado->fetch_assoc()):
          $estado = '';
          if ($row['fecha_vencimiento'] < date('Y-m-d')) {
            $estado = '<span class="vencido">Vencido</span>';
          } elseif ($row['clases_restantes'] <= 0) {
            $estado = '<span class="sin-clases">Sin clases disponibles</span>';
          } else {
            $estado = '<span class="activo">Activo</span>';
          }
        ?>
        <tr>
          <td><?= htmlspecialchars($row['apellido'] . ', ' . $row['nombre']) ?></td>
          <td><?= htmlspecialchars($row['dni']) ?></td>
          <td><?= $row['clases_restantes'] ?></td>
          <td><?= $row['asistencias_mes'] ?></td>
          <td><?= $estado ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary mt-3">Volver al inicio</a>
  </div>
</body>
</html>
