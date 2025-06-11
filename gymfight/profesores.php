<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profesores - Fight Academy Scorpions</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #111;
      color: #f1f1f1;
      margin: 0;
      padding-top: 60px;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
    }

    h1 {
      color: #ffc107;
      text-align: center;
      margin-bottom: 20px;
    }

    .btn {
      background-color: #ffc107;
      color: #111;
      padding: 10px 18px;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      text-decoration: none;
      margin-bottom: 20px;
      display: inline-block;
    }

    .btn:hover {
      background-color: #e0a800;
      color: #fff;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px;
      border: 1px solid #333;
      text-align: left;
    }

    th {
      background-color: #333;
      color: #ffc107;
    }

    .acciones a {
      margin-right: 10px;
      text-decoration: none;
      font-weight: bold;
    }

    .acciones .editar {
      color: #ffc107;
    }

    .acciones .eliminar {
      color: #e74c3c;
    }

    .acciones .eliminar:hover {
      color: #ff6b6b;
    }
  </style>
</head>
<body>
<div class="container">
  <h1>Listado de Profesores</h1>

  <a class="btn" href="agregar_profesor.php">Agregar Nuevo Profesor</a>

  <?php
  $conn = new mysqli("localhost", "root", "", "gymfight");
  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }

  if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);
    $conn->query("DELETE FROM profesores WHERE id = $idEliminar");
    echo "<script>location.href='profesores.php';</script>";
  }

  $result = $conn->query("SELECT * FROM profesores ORDER BY apellido, nombre");

  if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Email</th><th>Teléfono</th><th>Acciones</th></tr>";
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
      echo "<td>" . htmlspecialchars($row['apellido']) . "</td>";
      echo "<td>" . htmlspecialchars($row['dni']) . "</td>";
      echo "<td>" . htmlspecialchars($row['email']) . "</td>";
      echo "<td>" . htmlspecialchars($row['telefono']) . "</td>";
      echo "<td class='acciones'>
              <a class='editar' href='editar_profesor.php?id=" . $row['id'] . "'>Editar</a>
              <a class='eliminar' href='profesores.php?eliminar=" . $row['id'] . "' onclick=\"return confirm('¿Eliminar este profesor?');\">Eliminar</a>
            </td>";
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "<p>No hay profesores cargados.</p>";
  }

  $conn->close();
  ?>
</div>
</body>
</html>
