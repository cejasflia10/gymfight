<?php
include 'conexion.php';
include 'menu.php';

if (!isset($_GET['id'])) {
    echo "ID de profesor no especificado.";
    exit;
}

$id = intval($_GET['id']);
$stmt = $conexion->prepare("SELECT * FROM profesores WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Profesor no encontrado.";
    exit;
}

$profesor = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Profesor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-left: 260px; padding-top: 30px; }
        @media (max-width: 768px) {
            .container { margin-left: 0; }
        }
    </style>
</head>
<body class="bg-light">
<div class="container">
    <h2 class="mb-4 text-center">Editar Profesor</h2>

    <form action="actualizar_profesor.php" method="POST" class="bg-white p-4 rounded shadow-sm">
        <input type="hidden" name="id" value="<?= $profesor['id'] ?>">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="<?= htmlspecialchars($profesor['nombre']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="form-control" value="<?= htmlspecialchars($profesor['apellido']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="dni" class="form-label">DNI:</label>
            <input type="text" name="dni" id="dni" class="form-control" value="<?= htmlspecialchars($profesor['dni']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="<?= htmlspecialchars($profesor['telefono']) ?>">
        </div>

        <div class="mb-3">
            <label for="rfid_uid" class="form-label">RFID UID:</label>
            <input type="text" name="rfid_uid" id="rfid_uid" class="form-control" value="<?= htmlspecialchars($profesor['rfid_uid']) ?>">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="listar_profesor.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
