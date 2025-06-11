<?php
include 'conexion.php';
include 'menu.php';

$query = "
SELECT v.id, v.producto, v.fecha, v.metodo_pago, v.monto, c.nombre, c.apellido
FROM ventas v
LEFT JOIN clientes c ON v.cliente_id = c.id
ORDER BY v.fecha DESC
";
$result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ventas de Productos</title>
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
  <h2 class="text-center mb-4">📦 Ventas de Productos</h2>

  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Producto</th>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Método de Pago</th>
        <th>Monto ($)</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['producto']) ?></td>
            <td><?= htmlspecialchars($row['nombre'] . ' ' . $row['apellido']) ?></td>
            <td><?= $row['fecha'] ?></td>
            <td><?= $row['metodo_pago'] ?></td>
            <td>$<?= number_format($row['monto'], 2) ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="6" class="text-center">No hay ventas registradas.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <a href="index.php" class="btn btn-volver">🔙 Volver al Panel</a>
</div>
</body>
</html>
