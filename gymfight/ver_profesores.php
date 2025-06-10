<?php
require 'conexion.php';

$resultado = $mysqli->query("SELECT id, nombre, rfid_uid FROM profesores ORDER BY nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Profesores</title>
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
            text-align: center;
            border: 1px solid #444;
        }
        th {
            background-color: #333;
            color: #f0a500;
        }
        tr:nth-child(even) {
            background-color: #222;
        }
        .uid-vacio {
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>Profesores Registrados</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>UID RFID</th>
    </tr>
    <?php while ($row = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
        <td class="<?php echo empty($row['rfid_uid']) ? 'uid-vacio' : ''; ?>">
            <?php echo $row['rfid_uid'] ?: 'No asignado'; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>