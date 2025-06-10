<?php
require 'conexion.php';

$tarifas = $mysqli->query("SELECT * FROM planes_membresia ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tarifas de Planes</title>
    <style>
        body {
            background-color: #1a1a1a;
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
            border: 1px solid #444;
            padding: 12px;
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

<h1>Tarifas de Planes</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre del Plan</th>
        <th>Cantidad de Clases</th>
        <th>Duración (días)</th>
        <th>Precio</th>
    </tr>
    <?php while ($row = $tarifas->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
        <td><?php echo is_null($row['cantidad_clases']) ? 'Ilimitado' : $row['cantidad_clases']; ?></td>
        <td><?php echo $row['duracion_dias']; ?></td>
        <td>$<?php echo number_format($row['precio'], 2); ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>