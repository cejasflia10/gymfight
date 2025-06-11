<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resumen de Pagos a Profesores</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
      background: #fff;
      border-radius: 6px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    h1 {
      color: #f0a500;
      margin-bottom: 20px;
    }
    form {
      margin-bottom: 20px;
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      align-items: center;
    }
    label {
      font-weight: bold;
    }
    input, select {
      padding: 6px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .btn {
      background-color: #f0a500;
      border: none;
      color: #222;
      padding: 8px 14px;
      border-radius: 5px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn:hover {
      background-color: #d18e00;
      color: #fff;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #f0a500;
      color: #222;
    }
  </style>
</head>
<body>
<div class="container">
  <h1>Resumen de Pagos a Profesores</h1>

  <form method="GET" action="">
    <label for="profesor_id">Profesor:</label>
    <select name="profesor_id" id="profesor_id">
      <option value="">Todos</option>
      <?php
        $conn = new mysqli("localhost", "root", "", "gymfight");
        $profesores = $conn->query("SELECT id, nombre, apellido FROM profesores ORDER BY apellido");
        while ($prof = $profesores->fetch_assoc()) {
          $selected = (isset($_GET['profesor_id']) && $_GET['profesor_id'] == $prof['id']) ? 'selected' : '';
          echo "<option value='{$prof['id']}' $selected>{$prof['apellido']} {$prof['nombre']}</option>";
        }
      ?>
    </select>

    <label for="desde">Desde:</label>
    <input type="date" name="desde" id="desde" value="<?= $_GET['desde'] ?? '' ?>">

    <label for="hasta">Hasta:</label>
    <input type="date" name="hasta" id="hasta" value="<?= $_GET['hasta'] ?? '' ?>">

    <button type="submit" class="btn">Filtrar</button>
  </form>

  <?php
    $where = "WHERE 1=1";

    if (!empty($_GET['profesor_id'])) {
      $profesor_id = intval($_GET['profesor_id']);
      $where .= " AND cr.profesor_id = $profesor_id";
    }

    if (!empty($_GET['desde'])) {
      $desde = $conn->real_escape_string($_GET['desde']);
      $where .= " AND cr.dia >= '$desde'";
    }

    if (!empty($_GET['hasta'])) {
      $hasta = $conn->real_escape_string($_GET['hasta']);
      $where .= " AND cr.dia <= '$hasta'";
    }

    $sql = "
      SELECT 
        cr.id,
        cr.dia,
        cr.hora,
        p.nombre AS nombre_prof,
        p.apellido AS apellido_prof,
        t.dia_semana,
        t.hora_inicio,
        t.pago_por_clase
      FROM clases_realizadas cr
      JOIN profesores p ON cr.profesor_id = p.id
      JOIN turnos t ON cr.turno_id = t.id
      $where
      ORDER BY cr.dia DESC, cr.hora DESC
    ";

    $result = $conn->query($sql);

    $total = 0;
    if ($result->num_rows > 0) {
      echo "<table>";
      echo "<tr><th>Fecha</th><th>Hora</th><th>Profesor</th><th>Día Turno</th><th>Hora Turno</th><th>Pago por Clase</th></tr>";
      while ($row = $result->fetch_assoc()) {
        $total += $row['pago_por_clase'];
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['dia']) . "</td>";
        echo "<td>" . htmlspecialchars($row['hora']) . "</td>";
        echo "<td>" . htmlspecialchars($row['apellido_prof'] . ' ' . $row['nombre_prof']) . "</td>";
        echo "<td>" . htmlspecialchars($row['dia_semana']) . "</td>";
        echo "<td>" . htmlspecialchars($row['hora_inicio']) . "</td>";
        echo "<td>$" . number_format($row['pago_por_clase'], 2) . "</td>";
        echo "</tr>";
      }
      echo "<tr><th colspan='5'>Total a pagar</th><th>$" . number_format($total, 2) . "</th></tr>";
      echo "</table>";
    } else {
      echo "<p>No se encontraron registros con los filtros seleccionados.</p>";
    }

    $conn->close();
  ?>
</div>
</body>
</html>
