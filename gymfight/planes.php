<?php
include 'conexion.php';
include 'menu.php';

// Eliminar plan si se solicita
if (isset($_GET['eliminar'])) {
  $idEliminar = (int)$_GET['eliminar'];
  $conexion->query("DELETE FROM tipos_membresia WHERE id = $idEliminar");
}

// Obtener todos los planes
$planes = $conexion->query("SELECT * FROM tipos_membresia ORDER BY nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Planes de Membresía</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #f1f1f1;
    }
    .container {
      margin-left: 250px;
      padding: 20px;
    }
    h2 {
      color: #ffc107;
    }
    table {
      background: #1e1e1e;
      color: #fff;
    }
    .btn {
      margin-right: 5px;
    }
    .btn-warning { color: #000; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Planes de Membresía</h2>
    <a href="agregar_plan.php" class="btn btn-success mb-3">Agregar Nuevo Plan</a>
    <table class="table table-dark table-striped table-bordered">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Clases</th>
          <th>Monto ($)</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $planes->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['nombre']) ?></td>
            <td><?= htmlspecialchars($row['clases']) ?></td>
            <td>$<?= number_format($row['monto'], 2) ?></td>
            <td>
              <a href="editar_plan.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
              <a href="planes.php?eliminar=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este plan?')">Eliminar</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
