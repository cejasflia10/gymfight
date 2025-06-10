<?php
include 'conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $profesor_id = $_POST['profesor_id'];
    $fecha = $_POST['fecha_pago'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];

    $stmt = $conexion->prepare("INSERT INTO pagos_profesores (profesor_id, fecha_pago, monto, descripcion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isds", $profesor_id, $fecha, $monto, $descripcion);

    if ($stmt->execute()) {
        $mensaje = "✅ Pago registrado correctamente.";
    } else {
        $mensaje = "❌ Error al registrar el pago.";
    }
}

$result_profesores = $conexion->query("SELECT * FROM profesores ORDER BY apellido");
$result_pagos = $conexion->query("
    SELECT p.fecha_pago, p.monto, p.descripcion, prof.nombre, prof.apellido 
    FROM pagos_profesores p 
    JOIN profesores prof ON p.profesor_id = prof.id
    ORDER BY p.fecha_pago DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagos a Profesores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="container py-4">
    <h2 class="mb-4 text-center">Registro de Pagos a Profesores</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-info text-center"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-3 rounded shadow-sm mb-4">
        <div class="row">
            <div class="col-md-3">
                <label class="form-label">Profesor:</label>
                <select name="profesor_id" class="form-select" required>
                    <option value="">Seleccione</option>
                    <?php while($p = $result_profesores->fetch_assoc()): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['apellido'] . ", " . $p['nombre'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Fecha:</label>
                <input type="date" name="fecha_pago" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Monto:</label>
                <input type="number" step="0.01" name="monto" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Descripción:</label>
                <input type="text" name="descripcion" class="form-control">
            </div>
        </div>
        <div class="mt-3 text-end">
            <button type="submit" class="btn btn-primary">Registrar Pago</button>
        </div>
    </form>

    <table class="table table-striped bg-white rounded shadow-sm">
        <thead>
            <tr><th>Profesor</th><th>Fecha</th><th>Monto ($)</th><th>Descripción</th></tr>
        </thead>
        <tbody>
            <?php while($pago = $result_pagos->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($pago['apellido'] . ", " . $pago['nombre']) ?></td>
                    <td><?= $pago['fecha_pago'] ?></td>
                    <td><?= number_format($pago['monto'], 2) ?></td>
                    <td><?= htmlspecialchars($pago['descripcion']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
