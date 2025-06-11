<?php
include 'conexion.php';
include 'menu.php';

if (!isset($_GET['id'])) {
    die("ID de cliente no proporcionado.");
}

$id = (int) $_GET['id'];
$resultado = $conexion->query("SELECT * FROM clientes WHERE id = $id");

if ($resultado->num_rows === 0) {
    die("Cliente no encontrado.");
}

$cliente = $resultado->fetch_assoc();

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $dni = trim($_POST["dni"]);
    $telefono = trim($_POST["telefono"]);
    $correo = trim($_POST["correo"]);
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $rfid_uid = trim($_POST["rfid_uid"]);

    $stmt = $conexion->prepare("UPDATE clientes SET nombre=?, apellido=?, dni=?, telefono=?, correo=?, fecha_nacimiento=?, rfid_uid=? WHERE id=?");
    $stmt->bind_param("sssssssi", $nombre, $apellido, $dni, $telefono, $correo, $fecha_nacimiento, $rfid_uid, $id);

    if ($stmt->execute()) {
        $mensaje = "✅ Cliente actualizado correctamente.";
        // Refrescamos los datos
        $cliente = array_merge($cliente, $_POST);
    } else {
        $mensaje = "❌ Error al actualizar el cliente: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container { margin-left: 260px; padding-top: 30px; max-width: 700px; }
    @media (max-width: 768px) {
      .container { margin-left: 0; }
    }
  </style>
</head>
<body class="bg-light">
<div class="container">
  <h2 class="mb-4">Editar Cliente</h2>

  <?php if ($mensaje): ?>
    <div class="alert alert-info"><?= $mensaje ?></div>
  <?php endif; ?>

  <form method="POST" class="bg-white p-4 rounded shadow-sm">
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre:</label>
      <input type="text" name="nombre" id="nombre" class="form-control" value="<?= htmlspecialchars($cliente['nombre']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="apellido" class="form-label">Apellido:</label>
      <input type="text" name="apellido" id="apellido" class="form-control" value="<?= htmlspecialchars($cliente['apellido']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="dni" class="form-label">DNI:</label>
      <input type="text" name="dni" id="dni" class="form-control" value="<?= htmlspecialchars($cliente['dni']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="telefono" class="form-label">Teléfono:</label>
      <input type="text" name="telefono" id="telefono" class="form-control" value="<?= htmlspecialchars($cliente['telefono']) ?>">
    </div>
    <div class="mb-3">
      <label for="correo" class="form-label">Correo:</label>
      <input type="email" name="correo" id="correo" class="form-control" value="<?= htmlspecialchars($cliente['correo']) ?>">
    </div>
    <div class="mb-3">
      <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
      <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="<?= $cliente['fecha_nacimiento'] ?>">
    </div>
    <div class="mb-3">
      <label for="rfid_uid" class="form-label">RFID UID (lector conectado):</label>
      <input type="text" name="rfid_uid" id="rfid_uid" class="form-control" value="<?= htmlspecialchars($cliente['rfid_uid']) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    <a href="clientes.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
</body>
</html>
