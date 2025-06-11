<?php
$conexion = new mysqli("localhost", "root", "", "gymfight");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$cliente_id = $_GET['cliente_id'] ?? null;
if (!$cliente_id) {
    echo "ID de cliente no proporcionado.";
    exit;
}

$stmt = $conexion->prepare("SELECT nombre, apellido FROM clientes WHERE id = ?");
$stmt->bind_param("i", $cliente_id);
$stmt->execute();
$cliente = $stmt->get_result()->fetch_assoc();

$stmt = $conexion->prepare("SELECT fecha_hora, membresia_id FROM asistencias WHERE cliente_id = ? ORDER BY fecha_hora DESC");
$stmt->bind_param("i", $cliente_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Historial de Asistencias</title>
<style>
    body {
        background: #121212;
        color: #eee;
        font-family: Arial, sans-serif;
        padding: 20px;
    }
    h1 {
        color: #f0a500;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 10px;
        border: 1px solid #444;
        text-align: center;
    }
    th {
        background: #333;
    }
    tr:nth-child(even) {
        background: #1e1e1e;
    }
</style>
</head>
<body>

<h1>Asistencias de <?= htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']) ?></h1>

<table>
    <thead>
        <tr>
            <th>Fecha y Hora</th>
            <th>Membresía</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?= $fila['fecha_hora'] ?></td>
            <td><?= $fila['membresia_id'] ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
