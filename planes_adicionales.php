<?php
include 'conexion.php';

$mensaje = "";

// Manejar eliminar plan adicional
if (isset($_GET['eliminar'])) {
    $idEliminar = (int)$_GET['eliminar'];
    $delete_stmt = $conexion->prepare("DELETE FROM planes_adicionales WHERE id = ?");
    $delete_stmt->bind_param("i", $idEliminar);
    if ($delete_stmt->execute()) {
        $mensaje = "✅ Plan adicional eliminado correctamente.";
    } else {
        $mensaje = "❌ Error al eliminar plan adicional: " . $conexion->error;
    }
}

// Manejar agregar nuevo plan adicional
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $monto = (float)$_POST['monto'];

    if (empty($nombre) || $monto <= 0) {
        $mensaje = "❌ Completa todos los campos correctamente.";
    } else {
        $insert_stmt = $conexion->prepare("INSERT INTO planes_adicionales (nombre, monto) VALUES (?, ?)");
        $insert_stmt->bind_param("sd", $nombre, $monto);
        if ($insert_stmt->execute()) {
            $mensaje = "✅ Plan adicional agregado correctamente.";
        } else {
            $mensaje = "❌ Error al agregar plan adicional: " . $conexion->error;
        }
    }
}

// Obtener todos los planes adicionales
$result_planes_adicionales = $conexion->query("SELECT * FROM planes_adicionales ORDER BY nombre");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Planes Adicionales - Alquiler de Protecciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="container py-4">
    <h2 class="mb-4 text-center">Planes Adicionales (Alquiler de Protecciones)</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-info text-center"><?= $mensaje ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-5">
            <form method="POST" class="bg-white p-4 rounded shadow-sm">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Plan Adicional</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required maxlength="100" />
                </div>
                <div class="mb-3">
                    <label for="monto" class="form-label">Monto ($)</label>
                    <input type="number" step="0.01" min="0" name="monto" id="monto" class="form-control" required />
                </div>
                <button type="submit" class="btn btn-primary">Agregar Plan Adicional</button>
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </form>
        </div>
        <div class="col-md-7">
            <table class="table table-bordered table-hover bg-white">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Monto ($)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($plan = $result_planes_adicionales->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($plan['nombre']) ?></td>
                        <td><?= number_format($plan['monto'], 2) ?></td>
                        <td>
                            <a href="planes_adicionales.php?eliminar=<?= $plan['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este plan adicional?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if ($result_planes_adicionales->num_rows === 0): ?>
                    <tr><td colspan="3" class="text-center">No hay planes adicionales registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>
