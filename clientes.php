<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Clientes - Fight Academy Scorpions</title>
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

    .search-box {
      margin-bottom: 20px;
      text-align: center;
    }

    .search-box input {
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #555;
      width: 300px;
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
  <script>
    function buscarCliente() {
      var input = document.getElementById("buscador").value.toLowerCase();
      var filas = document.getElementsByClassName("fila-cliente");

      for (var i = 0; i < filas.length; i++) {
        var texto = filas[i].innerText.toLowerCase();
        filas[i].style.display = texto.includes(input) ? "" : "none";
      }
    }
  </script>
</head>
<body>
<div class="container">
  <h1>Listado de Clientes</h1>

  <div class="search-box">
    <input type="text" id="buscador" placeholder="Buscar por nombre, apellido o DNI..." onkeyup="buscarCliente()">
  </div>

  <a class="btn" href="agregar_cliente.php">Agregar Nuevo Cliente</a>

  <?php
  $conexion = new mysqli("localhost", "root", "", "gymfight");
  if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
  }

  $sql = "SELECT * FROM clientes ORDER BY apellido, nombre";
  $resultado = $conexion->query($sql);

  if ($resultado->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Teléfono</th><th>Clases</th><th>Acciones</th></tr>";

    while($fila = $resultado->fetch_assoc()) {
      echo "<tr class='fila-cliente'>";
      echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
      echo "<td>" . htmlspecialchars($fila["apellido"]) . "</td>";
      echo "<td>" . htmlspecialchars($fila["dni"]) . "</td>";
      echo "<td>" . htmlspecialchars($fila["telefono"]) . "</td>";
      echo "<td>" . (isset($fila["clases_disponibles"]) ? $fila["clases_disponibles"] : "N/A") . "</td>";
      echo "<td class='acciones'>
              <a class='editar' href='editar_cliente.php?id=" . $fila["id"] . "'>Editar</a>
              <a class='eliminar' href='clientes.php?eliminar=" . $fila["id"] . "' onclick=\"return confirm('¿Seguro que deseas eliminar este cliente?')\">Eliminar</a>
            </td>";
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "<p>No hay clientes registrados.</p>";
  }

  if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);
    $conexion->query("DELETE FROM clientes WHERE id = $idEliminar");
    echo "<script>location.href='clientes.php';</script>";
  }

  $conexion->close();
  ?>
</div>
</body>
</html>
