<?php include 'menu.php'; ?>
<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #111;
      color: #ffc107;
    }
    .container {
      margin-left: 260px;
      padding: 40px 20px;
      max-width: 700px;
    }
    .card {
      background-color: #222;
      border: none;
      border-radius: 10px;
    }
    .form-label, .form-control {
      color: #ffc107;
    }
    .form-control {
      background-color: #333;
      border: 1px solid #555;
    }
    .btn-primary {
      background-color: #ffc107;
      color: #111;
      border: none;
    }
    .btn-primary:hover {
      background-color: #e0a800;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card p-4">
      <h2 class="text-center mb-4">Agregar Nuevo Cliente</h2>
      <form action="guardar_cliente.php" method="POST">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="mb-3">
          <label for="apellido" class="form-label">Apellido:</label>
          <input type="text" class="form-control" name="apellido" required>
        </div>
        <div class="mb-3">
          <label for="dni" class="form-label">DNI:</label>
          <input type="text" class="form-control" name="dni" required>
        </div>
        <div class="mb-3">
          <label for="telefono" class="form-label">Teléfono:</label>
          <input type="text" class="form-control" name="telefono">
        </div>
        <div class="mb-3">
          <label for="correo" class="form-label">Correo:</label>
          <input type="email" class="form-control" name="correo">
        </div>
        <div class="mb-3">
          <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
          <input type="date" class="form-control" name="fecha_nacimiento">
        </div>
        <div class="mb-3">
          <label for="rfid_uid" class="form-label">RFID UID (lector obligatorio):</label>
          <input type="text" class="form-control" name="rfid_uid" required>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Guardar Cliente</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
