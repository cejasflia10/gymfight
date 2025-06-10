<?php
include 'conexion.php';

$fechaHoy = date('Y-m-d');
$mesActual = date('Y-m');

// Totales por método de pago - Día
$sql_dia = "SELECT metodo_pago, SUM(monto_pagado) as total 
            FROM membresias 
            WHERE DATE(fecha_inicio) = ? 
            GROUP BY metodo_pago";
$stmt_dia = $conexion->prepare($sql_dia);
$stmt_dia->bind_param("s", $fechaHoy);
$stmt_dia->execute();
$resultado_dia = $stmt_dia->get_result();

$totales_dia = [];
while ($row = $resultado_dia->fetch_assoc()) {
    $totales_dia[$row['metodo_pago']] = $row['total'];
}

// Totales por método de pago - Mes
$sql_mes = "SELECT metodo_pago, SUM(monto_pagado) as total 
            FROM membresias 
            WHERE DATE_FORMAT(fecha_inicio, '%Y-%m') = ? 
            GROUP BY metodo_pago";
$stmt_mes = $conexion->prepare($sql_mes);
$stmt_mes->bind_param("s", $mesActual);
$stmt_mes->execute();
$resultado_mes = $stmt_mes->get_result();

$totales_mes = [];
while ($row = $resultado_mes->fetch_assoc()) {
    $totales_mes[$row['metodo_pago']] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Ventas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .container {
      max-width: 900px;
      margin: 40px auto;
    }
    h2 {
      color: #212529;
      margin-bottom: 20px;
    }
    .card {
      margin-bottom: 25px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .card-header {
      font-weight: bold;
      background-color: #343a40;
      color: white;
    }
    .table thead {
      background-color: #e9ecef;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="text-center">Reporte de Ventas</h2>

    <div class="card">
      <div class="card-header">Totales del Día (<?= date('d/m/Y') ?>)</div>
      <div class="card-body p-0">
        <table class="table mb-0">
          <thead>
            <tr>
              <th>Método de Pago</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $metodos = ['Efectivo', 'Transferencia', 'Débito', 'Crédito', 'Cuenta Corriente'];
              foreach ($metodos as $metodo):
                $monto = isset($totales_dia[$metodo]) ? number_format($totales_dia[$metodo], 2) : '0.00';
            ?>
              <tr>
                <td><?= $metodo ?></td>
                <td>$<?= $monto ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="card">
      <div class="card-header">Totales del Mes (<?= date('m/Y') ?>)</div>
      <div class="card-body p-0">
        <table class="table mb-0">
          <thead>
            <tr>
              <th>Método de Pago</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($metodos as $metodo):
                $monto = isset($totales_mes[$metodo]) ? number_format($totales_mes[$metodo], 2) : '0.00';
            ?>
              <tr>
                <td><?= $metodo ?></td>
                <td>$<?= $monto ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</body>
</html>
