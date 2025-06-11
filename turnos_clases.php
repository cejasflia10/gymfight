<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Turnos de Clases - Fight Academy Scorpions</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 0; padding-top: 60px; background:#f5f5f5; color:#222; }
    .container { max-width:1100px; margin: 20px auto; padding:15px; background:#fff; border-radius:6px; box-shadow:0 2px 6px rgba(0,0,0,0.1);}
    h1 { color:#f0a500; margin-bottom:20px;}
    label { display:block; margin-top:10px; font-weight:600;}
    select, input {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    .btn {
      background-color: #f0a500;
      border: none;
      color: #222;
      padding: 10px 18px;
      border-radius: 5px;
      font-weight: 600;
      cursor: pointer;
      margin-top: 15px;
      transition: background-color 0.3s ease;
    }
    .btn:hover { background-color: #d18e00; color: #fff; }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }
    th, td {
      padding: 8px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #f0a500;
      color: #222;
    }
    .delete-btn {
      background-color: #e63946;
      color: white;
      border: none;
      padding: 6px 10px;
      border-radius: 4px;
      cursor: pointer;
    }
    .delete-btn:hover {
      background-color: #b22232;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Asignar Turno de Clase a Profesor</h1>

    <?php
    $conn = new mysqli("localhost", "root", "", "gymfight");
    if ($conn->connect_error) {
      die("Error de conexión: " . $conn->connect_error);
    }

    // Procesar eliminación de turno
    if (isset($_GET['delete_id'])) {
      $delete_id = intval($_GET['delete_id']);
      $conn->query("DELETE FROM turnos_clases WHERE id = $delete_id");
      echo "<p style='color:green;'>Turno eliminado correctamente.</p>";
    }

    // Procesar formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $profesor_id = intval($_POST['profesor_id']);
      $dia_semana = $_POST['dia_semana'];
      $hora_inicio = $_POST['hora_inicio'];
      $hora_fin = $_POST['hora_fin'];
      $descripcion = trim($_POST['descripcion']);

      // Validar horarios
      if ($hora_inicio >= $hora_fin) {
        echo "<p style='color:red;'>La hora de inicio debe ser menor que la hora de fin.</p>";
      } else {
        $stmt = $conn->prepare("INSERT INTO turnos_clases (profesor_id, dia_semana, hora_inicio, hora_fin, descripcion) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $profesor_id, $dia_semana, $hora_inicio, $hora_fin, $descripcion);

        if ($stmt->execute()) {
          echo "<p style='color:green;'>Turno asignado correctamente.</p>";
        } else {
          echo "<p style='color:red;'>Error al asignar turno: " . $stmt->error . "</p>";
        }
        $stmt->close();
      }
    }

    // Obtener profesores para el select
    $profesores_result = $conn->query("SELECT id, nombre, apellido FROM profesores ORDER BY apellido, nombre");

    // Obtener turnos actuales con JOIN para mostrar profesor
    $turnos_result = $conn->query("SELECT t.id, p.nombre, p.apellido, t.dia_semana, t.hora_inicio, t.hora_fin, t.descripcion 
                                  FROM turnos_clases t 
                                  JOIN profesores p ON t.profesor_id = p.id
                                  ORDER BY FIELD(t.dia_semana, 'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'), t.hora_inicio");
    ?>

    <form method="post" action="">
      <label for="profesor_id">Profesor</label>
      <select id="profesor_id" name="profesor_id" required>
        <option value="">Seleccionar Profesor</option>
        <?php
        while ($row = $profesores_result->fetch_assoc()) {
          echo "<option value='{$row['id']}'>" . htmlspecialchars($row['apellido'] . ", " . $row['nombre']) . "</option>";
        }
        ?>
      </select>

      <label for="dia_semana">Día de la Semana</label>
      <select id="dia_semana" name="dia_semana" required>
        <option value="">Seleccionar Día</option>
        <option value="Lunes">Lunes</option>
        <option value="Martes">Martes</option>
        <option value="Miércoles">Miércoles</option>
        <option value="Jueves">Jueves</option>
        <option value="Viernes">Viernes</option>
        <option value="Sábado">Sábado</option>
        <option value="Domingo">Domingo</option>
      </select>

      <label for="hora_inicio">Hora Inicio</label>
      <input type="time" id="hora_inicio" name="hora_inicio" required>

      <label for="hora_fin">Hora Fin</label>
      <input type="time" id="hora_fin" name="hora_fin" required>

      <label for="descripcion">Descripción (Opcional)</label>
      <input type="text" id="descripcion" name="descripcion" placeholder="Ejemplo: Clase de Kickboxing para principiantes">

      <button type="submit" class="btn">Asignar Turno</button>
    </form>

    <h2>Turnos Actuales</h2>

    <?php if ($turnos_result->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Profesor</th>
            <th>Día</th>
            <th>Hora Inicio</th>
            <th>Hora Fin</th>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($turno = $turnos_result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($turno['apellido'] . ", " . $turno['nombre']) ?></td>
              <td><?= htmlspecialchars($turno['dia_semana']) ?></td>
              <td><?= htmlspecialchars($turno['hora_inicio']) ?></td>
              <td><?= htmlspecialchars($turno['hora_fin']) ?></td>
              <td><?= htmlspecialchars($turno['descripcion']) ?></td>
              <td>
                <a href="?delete_id=<?= $turno['id'] ?>" class="delete-btn" onclick="return confirm('¿Eliminar este turno?');">Eliminar</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No hay turnos asignados.</p>
    <?php endif; ?>

  </div>
</body>
</html>
