<?php
include 'conexion.php';
include 'menu.php';

$busqueda = $_GET['buscar'] ?? '';

$query = "
  SELECT m.*, c.nombre AS cliente_nombre, c.apellido AS cliente_apellido, 
         t.nombre AS plan_nombre, m.metodo_pago
  FROM membresias m
  JOIN clientes c ON m.cliente_id = c.id
  JOIN tipos_membresia t ON m.plan_id = t.id
  WHERE CONCAT(c.nombre, ' ', c.apellido) LIKE ?
  ORDER BY m.fecha_inicio DESC
";

$stmt = $conexion->prepare($query);
$like = '%' . $busqueda . '%';
$stmt->bind_param('s', $like);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Membresías</title>
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
    @media (max-width: 768px) {
      .container {
        margin-left: 0;
        padding: 20px;
      }
    }
    table {
      background-color: #1e1e1e;
      color: #fff;
    }
    .table thead {
      background-color: #f0a500;
      color: #121212;
    }
    .btn-primary {
      background-color: #f0a500;
      border: none;
      color: #121212;
      font-weight: bold;
    }
    .btn-primary:hover {
      background-color: #d18e00;
    }
    .form-control {
      background-color: #1e1e1e;
      color: #fff;
      border: 1px solid #444;
    }
  </style>
</head>
<body>
<div class="container">
  <h2 class="text-center mb-4">📋 Listado de Membresías</h2>

  <div class="mb-3 text-center">
    <a href="agregar_membresia.php" class="btn btn-primary mb-2">Registrar Nueva Membresía</a>
    <form method="GET" class="d-flex justify-content-center">
      <input type="text" name="buscar" placeholder="Buscar cliente..." value="<?= htmlspecialchars($busqueda) ?>" class="form-control w-50" oninput="this.form.submit()">
    </form>
  </div>

  <table class="table table-bordered table-hover mt-3">
    <thead>
      <tr>
        <th>Cliente</th>
        <th>Plan</th>
        <th>Inicio</th>
        <th>Vencimiento</th>
        <th>Clases Restantes</th>
        <th>Pago</th>
        <th>Método</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
          <td><?= strtoupper($fila['cliente_nombre'] . " " . $fila['cliente_apellido']) ?></td>
          <td><?= htmlspecialchars($fila['plan_nombre']) ?></td>
          <td><?= $fila['fecha_inicio'] ?></td>
          <td><?= $fila['fecha_vencimiento'] ?></td>
          <td><?= $fila['clases_restantes'] ?></td>
          <td>$<?= number_format($fila['monto_pagado'], 2) ?></td>
          <td><?= ucfirst($fila['metodo_pago']) ?></td>
          <td>
            <a href="editar_membresia.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="eliminar_membresia.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta membresía?')">Eliminar</a>
          </td>
        </tr>
      <?php endwhile; ?>
      <?php if ($resultado->num_rows === 0): ?>
        <tr><td colspan="8" class="text-center">No hay membresías registradas.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
</body>
</html>
