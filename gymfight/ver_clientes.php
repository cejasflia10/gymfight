<?php
include 'conexion.php';
include 'menu.php';

$query = "
    SELECT c.id, c.nombre, c.apellido, c.dni, c.telefono, c.email, c.rfid_uid,
           m.fecha_vencimiento,
           m.clases_restantes,
           DATEDIFF(m.fecha_vencimiento, CURDATE()) AS dias_restantes,
           CASE 
               WHEN m.fecha_vencimiento >= CURDATE() AND m.clases_restantes > 0 THEN 1
               ELSE 0
           END AS activo
    FROM clientes c
    LEFT JOIN (
        SELECT *
        FROM membresias
        WHERE fecha_vencimiento IS NOT NULL
        ORDER BY fecha_vencimiento DESC
    ) m ON c.id = m.cliente_id
    GROUP BY c.id
    ORDER BY activo DESC, m.fecha_vencimiento DESC, c.apellido, c.nombre
";

$resultado = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ver Clientes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
 <style>
  body {
    background-color: #121212;
    color: #f0a500;
    font-size: 14px;
  }
  .container {
    margin-left: 260px;
    padding: 40px 20px;
  }
  .table {
    background-color: #1e1e1e;
    color: white;
    font-size: 13px;
  }
  .table th, .table td {
    padding: 6px 8px;
    vertical-align: middle;
  }
  thead {
    background-color: #f0a500;
    color: #111;
  }
  input[type="text"] {
    width: 260px;
    margin-bottom: 15px;
    font-size: 13px;
  }
  .badge {
    font-size: 12px;
    padding: 5px 7px;
  }
</style>

</head>
<body>
  <div class="container">
    <h2 class="mb-4">👥 Lista de Clientes</h2>
    <input type="text" class="form-control" id="buscar" placeholder="Buscar por DNI, Email, Teléfono...">

    <table class="table table-bordered table-hover mt-3">
      <thead>
        <tr>
          <th>Apellido</th>
          <th>Nombre</th>
          <th>DNI</th>
          <th>Teléfono</th>
          <th>Email</th>
          <th>RFID</th>
          <th>Vencimiento</th>
          <th>Días Restantes</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody id="tabla-clientes">
        <?php while($row = $resultado->fetch_assoc()): ?>
          <tr>
            <td><?= $row['apellido'] ?></td>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['dni'] ?></td>
            <td><?= $row['telefono'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['rfid_uid'] ?></td>
            <td><?= $row['fecha_vencimiento'] ?? 'Sin membresía' ?></td>
            <td>
              <?php
              if ($row['fecha_vencimiento']) {
                echo $row['dias_restantes'] >= 0 ? $row['dias_restantes'] . ' días' : 'Vencida';
              } else {
                echo 'Sin datos';
              }
              ?>
            </td>
            <td>
              <?php
              if ($row['fecha_vencimiento'] && $row['dias_restantes'] >= 0 && $row['clases_restantes'] > 0) {
                  echo '<span class="badge bg-success">Activo</span>';
              } else {
                  echo '<span class="badge bg-danger">Inactivo</span>';
              }
              ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <script>
    document.getElementById("buscar").addEventListener("keyup", function() {
      const valor = this.value.toLowerCase();
      const filas = document.querySelectorAll("#tabla-clientes tr");
      filas.forEach(fila => {
        fila.style.display = fila.innerText.toLowerCase().includes(valor) ? "" : "none";
      });
    });
  </script>
</body>
</html>
