<?php
$mysqli = new mysqli("localhost", "root", "", "gymfight");
if ($mysqli->connect_errno) {
    die("Error en conexión: " . $mysqli->connect_error);
}

$clientes = $mysqli->query("SELECT id, nombre FROM clientes ORDER BY nombre");

$cliente_id = $_GET['cliente_id'] ?? '';
$fecha_desde = $_GET['fecha_desde'] ?? '';
$fecha_hasta = $_GET['fecha_hasta'] ?? '';

$asistencias = [];

if ($cliente_id && $fecha_desde && $fecha_hasta) {
    $stmt = $mysqli->prepare("SELECT a.fecha_hora FROM asistencias a WHERE a.cliente_id = ? AND a.fecha_hora BETWEEN ? AND ? ORDER BY a.fecha_hora DESC");
    $fecha_desde_db = $fecha_desde . " 00:00:00";
    $fecha_hasta_db = $fecha_hasta . " 23:59:59";
    $stmt->bind_param("iss", $cliente_id, $fecha_desde_db, $fecha_hasta_db);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($row = $resultado->fetch_assoc()) {
        $asistencias[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Reporte de Asistencia por Cliente y Fecha</title>
<style>
    body { font-family: Arial, sans-serif; background:#f9f9f9; color:#333; padding: 20px; }
    h1 { color: #f0a500; text-align:center; }
    form { max-width: 600px; margin: 0 auto 30px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
    label { display: block; margin-top: 15px; font-weight: bold; }
    select, input[type=date] { width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; }
    button { margin-top: 20px; background: #f0a500; border: none; padding: 12px; width: 100%; border-radius: 6px; font-weight: bold; cursor: pointer; }
    button:hover { background: #cf8c00; }
    table { border-collapse: collapse; width: 100%; max-width: 700px; margin: 0 auto; background: #fff; }
    th, td { padding: 12px; border: 1px solid #ccc; text-align: center; }
    th { background-color: #f0a500; color: #fff; }
    tr:nth-child(even) { background-color: #f2f2f2; }
    .sin-resultados { text-align: center; margin-top: 20px; font-style: italic; }
</style>
</head>
<body>

<h1>Reporte de Asistencia</h1>

<form method="GET">
    <label for="cliente_id">Seleccionar Cliente:</label>
    <select id="cliente_id" name="cliente_id" required>
        <option value="">-- Seleccione --</option>
        <?php while($c = $clientes->fetch_assoc()): ?>
            <option value="<?php echo $c['id']; ?>" <?php if($c['id'] == $cliente_id) echo 'selected'; ?>>
                <?php echo htmlspecialchars($c['nombre']); ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="fecha_desde">Fecha desde:</label>
    <input type="date" id="fecha_desde" name="fecha_desde" value="<?php echo htmlspecialchars($fecha_desde); ?>" required>

    <label for="fecha_hasta">Fecha hasta:</label>
    <input type="date" id="fecha_hasta" name="fecha_hasta" value="<?php echo htmlspecialchars($fecha_hasta); ?>" required>

    <button type="submit">Buscar Asistencias</button>
</form>

<?php if ($cliente_id && $fecha_desde && $fecha_hasta): ?>
    <?php if (count($asistencias) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha y Hora de Asistencia</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($asistencias as $index => $asis): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo date("d/m/Y H:i", strtotime($asis['fecha_hora'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="sin-resultados">No se encontraron asistencias en el período seleccionado.</p>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>
