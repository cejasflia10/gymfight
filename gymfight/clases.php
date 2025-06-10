<?php
require 'conexion.php';

$resultado = $mysqli->query("
    SELECT cr.id, cr.dia, cr.horario_inicio, cr.horario_fin, cr.es_recuperacion, p.nombre AS profesor
    FROM clases_realizadas cr
    LEFT JOIN profesores p ON cr.profesor_id = p.id
    ORDER BY cr.fecha DESC, cr.horario_inicio ASC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clases Realizadas</title>
    <style>
        body {
            background: #1a1a1a;
            color: #eee;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            color: #f0a500;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #444;
            text-align: center;
        }
        th {
            background-color: #333;
            color: #f0a500;
        }
        tr:nth-child(even) {
            background-color: #222;
        }
    </style>
</head>
<body>

<h1>Clases Realizadas</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Día</th>
        <th>Horario</th>
        <th>Recuperación</th>
        <th>Profesor</th>
    </tr>
    <?php while ($row = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['dia']; ?></td>
        <td><?php echo $row['horario_inicio'] . " a " . $row['horario_fin']; ?></td>
        <td><?php echo $row['es_recuperacion'] ? 'Sí' : 'No'; ?></td>
        <td><?php echo htmlspecialchars($row['profesor'] ?? 'No asignado'); ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
