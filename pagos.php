<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pagos - Fight Academy Scorpions</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding-top: 60px;
      background-color: #f5f5f5;
      color: #222;
    }
    .container {
      max-width: 1100px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 6px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    h1 {
      color: #f0a500;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }
    th {
      background-color: #f0a500;
      color: #222;
    }
    .btn {
      background-color: #f0a500;
      border: none;
      color: #222;
      padding: 10px 18px;
      border-radius: 5px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }
    .btn:hover {
      background-color: #d18e00;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Pagos Realizados</h1>

    <?php
    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "gymfight");
    if ($conn->connect_error) {
      die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta de pagos con datos del cliente
    $sql = "SELECT p.id, p.fecha, p.monto, c.nombre, c.apellido 
            FROM pagos p
            JOIN clientes c ON p.cliente_id = c.id
            ORDER BY p.fecha DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table>";
      echo "<tr><th>ID</th><th>Cliente</th><th>Fecha</th><th>Monto</th></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($row['id'])."</td>";
        echo "<td>".htmlspecialchars($row['apellido']).", ".htmlspecialchars($row['nombre'])."</td>";
        echo "<td>".htmlspecialchars($row['fecha'])."</td>";
        echo "<td>$".number_format($row['monto'], 2)."</td>";
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "<p>No hay pagos registrados.</p>";
    }

    $conn->close();
    ?>

    <a href="agregar_pago.php" class="btn">Registrar Nuevo Pago</a>
  </div>
</body>
</html>
