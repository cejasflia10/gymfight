<?php
include 'conexion.php';
include 'menu.php';

$hoy = date('Y-m-d');
$inicio_mes = date('Y-m-01');
$fin_mes = date('Y-m-t');

$metodos = ["Efectivo", "Transferencia", "Débito", "Crédito", "Cuenta Corriente"];
$totales_dia = [];
$totales_mes = [];

foreach ($metodos as $metodo) {
    $query_dia = $conexion->prepare("SELECT SUM(monto) as total FROM ventas WHERE metodo_pago = ? AND fecha = ?");
    $query_dia->bind_param("ss", $metodo, $hoy);
    $query_dia->execute();
    $res_dia = $query_dia->get_result()->fetch_assoc();
    $totales_dia[$metodo] = $res_dia['total'] ?? 0;

    $query_mes = $conexion->prepare("SELECT SUM(monto) as total FROM ventas WHERE metodo_pago = ? AND fecha BETWEEN ? AND ?");
    $query_mes->bind_param("sss", $metodo, $inicio_mes, $fin_mes);
    $query_mes->execute();
    $res_mes = $query_mes->get_result()->fetch_assoc();
    $totales_mes[$metodo] = $res_mes['total'] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Reporte de Ventas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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
    table {
      background-color: #1e1e1e;
      color: #fff;
    }
    .table thead {
      background-color: #f0a500;
      color: #121212;
    }
  </style>
</head>
<body>
<div class="container">
  <h2 class="mb-4 text-center">📊 Reporte de Ventas</h2>

  <h4>Totales del Día (<?= $hoy ?>)</h4>
  <table class="table table-bordered table-hover mb-5">
    <thead>
      <tr>
        <th>Método de Pago</th>
        <th>Total del Día</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($totales_dia as $metodo => $monto): ?>
        <tr>
          <td><?= $metodo ?></td>
          <td>$<?= number_format($monto, 2) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h4>Totales del Mes (<?= date('m/Y') ?>)</h4>
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Método de Pago</th>
        <th>Total del Mes</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($totales_mes as $metodo => $monto): ?>
        <tr>
          <td><?= $metodo ?></td>
          <td>$<?= number_format($monto, 2) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
