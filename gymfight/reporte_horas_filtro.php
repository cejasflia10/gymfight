<?php
require 'conexion.php';

$mes_actual = date('Y-m');
$mes = $_GET['mes'] ?? $mes_actual;
$fecha_inicio = "$mes-01";
$fecha_fin = date("Y-m-t", strtotime($fecha_inicio));

$profesores = $mysqli->query("SELECT id, nombre FROM profesores ORDER BY nombre");
$reportes = [];

foreach ($profesores as $prof) {
    $id = $prof['id'];
    $nombre = $prof['nombre'];
    $eventos = $mysqli->prepare("
        SELECT tipo_evento, fecha_hora 
        FROM rfid_logs 
        WHERE profesor_id = ? AND fecha_hora BETWEEN ? AND ? 
        ORDER BY fecha_hora ASC
    ");
    $eventos->bind_param("iss", $id, $fecha_inicio, $fecha_fin);
    $eventos->execute();
    $resultado = $eventos->get_result();

    $total_segundos = 0;
    $entrada = null;

    while ($ev = $resultado->fetch_assoc()) {
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
    <title>Reporte Mensual de Horas por Profesor</title>
    <style>
        body {
            background: #1a1a1a;
            color: #eee;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #f0a500;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        select {
            padding: 8px;
            font-size: 1rem;
            border-radius: 6px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
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

<h1>Horas Trabajadas por Profesor (<?php echo date("F Y", strtotime($mes)); ?>)</h1>

<form method="GET">
    <label for="mes">Seleccionar mes: </label>
    <input type="month" name="mes" id="mes" value="<?php echo $mes; ?>">
    <button type="submit">Filtrar</button>
</form>

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