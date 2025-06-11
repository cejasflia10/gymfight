<?php
include 'conexion.php';
include 'menu.php';

$mensaje = "";

// Eliminar plan
if (isset($_GET['eliminar'])) {
    $id = (int)$_GET['eliminar'];
    $stmt = $conexion->prepare("DELETE FROM tipos_membresia WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $mensaje = "✅ Plan eliminado correctamente.";
    } else {
        $mensaje = "❌ Error al eliminar el plan.";
    }
}

// Agregar nuevo plan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $duracion = (int)$_POST['duracion_dias'];
    $clases = (int)$_POST['cantidad_clases'];
    $precio = (float)$_POST['precio'];

    if ($nombre && $duracion >= 0 && $clases >= 0 && $precio >= 0) {
        $stmt = $conexion->prepare("INSERT INTO tipos_membresia (nombre, duracion_dias, cantidad_clases, precio) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siid", $nombre, $duracion, $clases, $precio);
        if ($stmt->execute()) {
            $mensaje = "✅ Plan agregado correctamente.";
        } else {
            $mensaje = "❌ Error al agregar el plan.";
        }
    } else {
        $mensaje = "❌ Complete todos los campos correctamente.";
    }
}

$planes = $conexion->query("SELECT * FROM tipos_membresia ORDER BY nombre ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tipos de Membresía</title>
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
    <h2 class="mb-4 text-center">Planes de Membresía</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-info text-center"><?= $mensaje ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-5">
            <form method="POST" class="bg-white p-4 rounded shadow-sm">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Plan</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required maxlength="100">
                </div>
                <div class="mb-3">
                    <label for="duracion_dias" class="form-label">Duración (días)</label>
                    <input type="number" name="duracion_dias" id="duracion_dias" class="form-control" min="0" required>
                </div>
                <div class="mb-3">
                    <label for="cantidad_clases" class="form-label">Cantidad de Clases</label>
                    <input type="number" name="cantidad_clases" id="cantidad_clases" class="form-control" min="0" required>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio ($)</label>
                    <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Agregar Plan</button>
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </form>
        </div>

        <div class="col-md-7">
            <table class="table table-bordered bg-white shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Días</th>
                        <th>Clases</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($plan = $planes->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($plan['nombre']) ?></td>
                        <td><?= $plan['duracion_dias'] ?></td>
                        <td><?= $plan['cantidad_clases'] ?></td>
                        <td>$<?= number_format($plan['precio'], 2) ?></td>
                        <td>
                            <a href="?eliminar=<?= $plan['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este plan?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if ($planes->num_rows === 0): ?>
                    <tr><td colspan="5" class="text-center">No hay planes registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
