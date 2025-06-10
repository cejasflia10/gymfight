<?php
require 'conexion.php';

$rfid = $_POST['rfid_uid'] ?? '';
$mensaje = "";

if ($rfid) {
    // Buscar profesor por RFID
    $stmt = $mysqli->prepare("SELECT id, nombre FROM profesores WHERE rfid_uid = ?");
    $stmt->bind_param("s", $rfid);
    $stmt->execute();
    $profesor = $stmt->get_result()->fetch_assoc();

    if ($profesor) {
        $profesor_id = $profesor['id'];
        $nombre = $profesor['nombre'];
        $ahora = date('Y-m-d H:i:s');

        // Obtener último registro del día
        $fecha_hoy = date('Y-m-d');
        $check = $mysqli->prepare("
            SELECT tipo_evento FROM rfid_logs 
            WHERE profesor_id = ? AND DATE(fecha_hora) = ? 
            ORDER BY fecha_hora DESC LIMIT 1
        ");
        $check->bind_param("is", $profesor_id, $fecha_hoy);
        $check->execute();
        $ultimo = $check->get_result()->fetch_assoc();

        // Determinar tipo de evento
        $tipo_evento = ($ultimo && $ultimo['tipo_evento'] == 'entrada') ? 'salida' : 'entrada';

        // Registrar evento
        $insert = $mysqli->prepare("INSERT INTO rfid_logs (profesor_id, rfid_uid, tipo_evento, fecha_hora) VALUES (?, ?, ?, ?)");
        $insert->bind_param("isss", $profesor_id, $rfid, $tipo_evento, $ahora);
        $insert->execute();

        $mensaje = "✅ $tipo_evento registrada para el profesor: $nombre a las " . date('H:i:s');
    } else {
        $mensaje = "❌ Tarjeta no asignada a ningún profesor.";
    }
} else {
    $mensaje = "❌ No se recibió UID.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro RFID Profesor</title>
    <style>
        body {
            background: #1a1a1a;
            color: #eee;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
        }
        h1 {
            color: #f0a500;
        }
        form {
            background: #222;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
        }
        label, input {
            display: block;
            width: 100%;
            margin-top: 10px;
        }
        input[type="text"] {
            padding: 10px;
            border-radius: 6px;
            border: none;
            font-size: 1rem;
        }
        button {
            margin-top: 20px;
            padding: 12px;
            font-weight: bold;
            background: #f0a500;
            border: none;
            border-radius: 6px;
            width: 100%;
            cursor: pointer;
        }
        .mensaje {
            margin-top: 20px;
            padding: 15px;
            background: #2ecc71;
            border-radius: 6px;
            text-align: center;
            font-weight: bold;
        }
        .error {
            background: #c0392b;
        }
    </style>
</head>
<body>

<h1>Escaneo de Profesor (RFID)</h1>

<form method="POST">
    <label for="rfid_uid">Escanear tarjeta RFID:</label>
    <input type="text" name="rfid_uid" id="rfid_uid" autofocus autocomplete="off" required>

    <button type="submit">Registrar</button>
</form>

<?php if ($mensaje): ?>
    <div class="mensaje <?php echo str_contains($mensaje, '❌') ? 'error' : ''; ?>">
        <?php echo $mensaje; ?>
    </div>
<?php endif; ?>

</body>
</html>