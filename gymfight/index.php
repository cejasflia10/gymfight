<?php
include 'conexion.php';
include 'menu.php';

date_default_timezone_set('America/Argentina/Buenos_Aires');
$hoy = date('Y-m-d');
$mes_actual = date('Y-m');

// Ingreso del día (pagos de membresías)
$consulta_dia = $conexion->prepare("SELECT SUM(monto_pagado) AS total FROM membresias WHERE fecha_inicio = ?");
$consulta_dia->bind_param("s", $hoy);
$consulta_dia->execute();
$resultado_dia = $consulta_dia->get_result()->fetch_assoc();
$ingreso_dia = $resultado_dia['total'] ?? 0;

// Ingreso del mes (pagos de membresías)
$consulta_mes = $conexion->prepare("SELECT SUM(monto_pagado) AS total FROM membresias WHERE DATE_FORMAT(fecha_inicio, '%Y-%m') = ?");
$consulta_mes->bind_param("s", $mes_actual);
$consulta_mes->execute();
$resultado_mes = $consulta_mes->get_result()->fetch_assoc();
$ingreso_mes = $resultado_mes['total'] ?? 0;

// Ventas del mes (productos)
$ventas_mes = $conexion->query("SELECT SUM(precio_venta) AS total FROM ventas_productos WHERE DATE_FORMAT(fecha_venta, '%Y-%m') = '$mes_actual'");
$ventas_total = $ventas_mes->fetch_assoc()['total'] ?? 0;

// Clientes activos
$activos = $conexion->query("SELECT COUNT(*) AS total FROM membresias WHERE fecha_vencimiento >= '$hoy' AND clases_restantes > 0");
$total_activos = $activos->fetch_assoc()['total'] ?? 0;

// Cumpleaños próximos (7 días)
$cumples = $conexion->query("
    SELECT CONCAT(nombre, ' ', apellido) AS nombre, DATE_FORMAT(fecha_nacimiento, '%d/%m') AS cumple
    FROM clientes
    WHERE DATE_FORMAT(fecha_nacimiento, '%m-%d') BETWEEN DATE_FORMAT(NOW(), '%m-%d') AND DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 7 DAY), '%m-%d')
    ORDER BY fecha_nacimiento
");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Control</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #111;
      color: #f0a500;
      font-family: 'Segoe UI', sans-serif;
    }
    .container {
      margin-left: 260px;
      padding: 40px 20px;
    }
    h2 {
      color: #f0a500;
      margin-bottom: 20px;
    }
    .card {
      background-color: #222;
      border: 2px solid #f0a500;
      color: white;
      margin-bottom: 20px;
      border-radius: 10px;
    }
    .card-title {
      color: #f0a500;
      font-size: 18px;
    }
    .card-body {
      font-size: 24px;
      font-weight: bold;
    }
    .cumples {
      background: #222;
      border: 2px solid #f0a500;
      color: white;
      border-radius: 10px;
      padding: 20px;
    }
    .cumples ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .cumples li {
      padding: 4px 0;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="text-center">Panel de Control</h2>
    <div class="row">
      <div class="col-md-3">
        <div class="card text-center">
          <div class="card-title mt-2">💰 Ingreso del Día</div>
          <div class="card-body text-white">$<?= number_format($ingreso_dia, 2) ?></div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-center">
          <div class="card-title mt-2">📆 Ingreso del Mes</div>
          <div class="card-body text-white">$<?= number_format($ingreso_mes, 2) ?></div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-center">
          <div class="card-title mt-2">🛒 Ventas del Mes</div>
          <div class="card-body text-white">$<?= number_format($ventas_total, 2) ?></div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-center">
          <div class="card-title mt-2">💪 Alumnos Activos</div>
          <div class="card-body text-white"><?= $total_activos ?></div>
        </div>
      </div>
    </div>

    <div class="cumples mt-4">
      <h4>🎉 Próximos Cumpleaños</h4>
      <ul>
        <?php if ($cumples->num_rows > 0): ?>
          <?php while($c = $cumples->fetch_assoc()): ?>
            <li><?= $c['nombre'] ?> - <?= $c['cumple'] ?></li>
          <?php endwhile; ?>
        <?php else: ?>
          <li>No hay cumpleaños próximos</li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</body>
</html>
