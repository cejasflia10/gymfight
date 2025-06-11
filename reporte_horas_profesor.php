<?php
require 'conexion.php';

$profesores = $mysqli->query("SELECT id, nombre FROM profesores ORDER BY nombre");
$reportes = [];

foreach ($profesores as $prof) {
    $id = $prof['id'];
    $nombre = $prof['nombre'];
    $eventos = $mysqli->query("
        SELECT tipo_evento, fecha_hora 
        FROM rfid_logs 
        WHERE profesor_id = $id 
        ORDER BY fecha_hora ASC
    ");

    $total_segundos = 0;
    $entrada = null;

    while ($ev = $eventos->fetch_assoc()) {
        if ($ev['tipo_evento'] === 'entrada') {
            $entrada = strtotime($ev['fecha_hora']);
        } elseif ($ev['tipo_evento'] === 'salida' && $entrada !== null) {
            $salida = strtotime($ev['fecha_hora']);
            $total_segundos += ($salida - $entrada);
            $entrada = null;
        }
    }

    $horas = floor($total_segundos / 3600);
    $minutos = floor(($total_segundos % 3600) / 60);
    $reportes[] = [
        'nombre' => $nombre,
        'horas' => $horas,
        'minutos' => $minutos
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horas Trabajadas por Profesor</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: #eee;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #f0a500;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
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

<h1>Reporte de Horas Trabajadas por Profesor</h1>

<table>
    <tr>
        <th>Profesor</th>
        <th>Horas Trabajadas</th>
    </tr>
    <?php foreach ($reportes as $rep): ?>
    <tr>
        <td><?php echo htmlspecialchars($rep['nombre']); ?></td>
        <td><?php echo "{$rep['horas']} h {$rep['minutos']} min"; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>