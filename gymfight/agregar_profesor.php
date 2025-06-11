<?php
include 'conexion.php';
include 'menu.php';

$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $rfid_uid = trim($_POST['rfid_uid']);

    if ($nombre && $apellido && $rfid_uid) {
        $stmt = $conexion->prepare("INSERT INTO profesores (nombre, apellido, email, telefono, rfid_uid) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $apellido, $email, $telefono, $rfid_uid);
        if ($stmt->execute()) {
            $mensaje = "✅ Profesor agregado correctamente.";
        } else {
            $mensaje = "❌ Error al guardar.";
        }
    } else {
        $mensaje = "❌ Completa los campos obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Profesor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .container {
            margin-left: 260px;
            padding-top: 30px;
            max-width: 600px;
        }
        @media (max-width: 768px) {
            .container {
                margin-left: 0;
            }
        }
    </style>
</head>
<body class="bg-dark text-light">
<div class="container">
    <h2 class="text-center text-warning mb-4">Agregar Profesor</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-info"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-black p-4 rounded shadow">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control">
        </div>
        <div class="mb-3">
            <label for="rfid_uid" class="form-label">Tarjeta RFID (UID):</label>
            <input type="text" name="rfid_uid" id="rfid_uid" class="form-control" required placeholder="Esperando tarjeta...">
        </div>
        <button type="submit" class="btn btn-warning w-100 fw-bold">Guardar Profesor</button>
    </form>
</div>
</body>
</html>
