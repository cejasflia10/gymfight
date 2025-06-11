<?php
include 'conexion.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');
$rfid = $_GET['rfid'] ?? '';
$mensaje = "";
$tipo_alerta = "";

if ($rfid) {
    $stmt = $conexion->prepare("SELECT id, nombre, apellido FROM clientes WHERE rfid_uid = ?");
    $stmt->bind_param("s", $rfid);
    $stmt->execute();
    $cliente = $stmt->get_result()->fetch_assoc();

    if ($cliente) {
        $stmt = $conexion->prepare("SELECT id, clases_restantes, fecha_vencimiento FROM membresias WHERE cliente_id = ? AND clases_restantes > 0 AND fecha_vencimiento >= CURDATE() ORDER BY id DESC LIMIT 1");
        $stmt->bind_param("i", $cliente['id']);
        $stmt->execute();
        $membresia = $stmt->get_result()->fetch_assoc();

        if ($membresia) {
            $stmt = $conexion->prepare("INSERT INTO asistencias (cliente_id, membresia_id, fecha_hora) VALUES (?, ?, NOW())");
            $stmt->bind_param("ii", $cliente['id'], $membresia['id']);
            $stmt->execute();

            $conexion->query("UPDATE membresias SET clases_restantes = clases_restantes - 1 WHERE id = {$membresia['id']}");
            $restantes = $membresia['clases_restantes'] - 1;
            $mensaje = "✅ {$cliente['nombre']} {$cliente['apellido']} ingresó. Clases restantes: {$restantes}";
            $tipo_alerta = "ok";
        } else {
            $mensaje = "❌ {$cliente['nombre']} {$cliente['apellido']} - Membresía vencida o sin clases disponibles.";
            $tipo_alerta = "error";
        }
    } else {
        $stmt = $conexion->prepare("SELECT id, nombre, apellido FROM profesores WHERE rfid_uid = ?");
        $stmt->bind_param("s", $rfid);
        $stmt->execute();
        $profesor = $stmt->get_result()->fetch_assoc();

        if ($profesor) {
            $stmt = $conexion->prepare("SELECT id, hora_entrada, hora_salida FROM ingresos_profesores WHERE profesor_id = ? AND DATE(fecha) = CURDATE() ORDER BY id DESC LIMIT 1");
            $stmt->bind_param("i", $profesor['id']);
            $stmt->execute();
            $ultimo = $stmt->get_result()->fetch_assoc();

            if (!$ultimo || $ultimo['hora_salida']) {
                $stmt = $conexion->prepare("INSERT INTO ingresos_profesores (profesor_id, fecha, hora_entrada) VALUES (?, CURDATE(), CURTIME())");
                $stmt->bind_param("i", $profesor['id']);
                $stmt->execute();
                $mensaje = "✅ Ingreso registrado para {$profesor['nombre']} {$profesor['apellido']}.";
                $tipo_alerta = "ok";
            } else {
                $stmt = $conexion->prepare("UPDATE ingresos_profesores SET hora_salida = CURTIME() WHERE id = ?");
                $stmt->bind_param("i", $ultimo['id']);
                $stmt->execute();
                $mensaje = "🚪 Salida registrada para {$profesor['nombre']} {$profesor['apellido']}.";
                $tipo_alerta = "ok";
            }
        } else {
            $mensaje = "❌ Tarjeta no registrada.";
            $tipo_alerta = "error";
        }
    }
}

$asistencias = $conexion->query("SELECT c.nombre, c.apellido, a.fecha_hora, m.clases_restantes FROM asistencias a JOIN clientes c ON a.cliente_id = c.id JOIN membresias m ON a.membresia_id = m.id WHERE DATE(a.fecha_hora) = CURDATE() ORDER BY a.fecha_hora DESC");
$ingresos = $conexion->query("SELECT p.nombre, p.apellido, ip.hora_entrada, ip.hora_salida, ip.fecha FROM ingresos_profesores ip JOIN profesores p ON ip.profesor_id = p.id WHERE ip.fecha = CURDATE() ORDER BY ip.hora_entrada DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Asistencia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #000; color: #fff; font-family: 'Segoe UI', sans-serif; }
    .container { max-width: 1000px; margin: 30px auto; background: #111; padding: 30px; border-radius: 10px; box-shadow: 0 0 20px rgba(255,255,255,0.1); }
    h2, h5 { color: #f0a500; }
    .form-control { background: #222; color: #fff; border: 1px solid #444; }
    .btn-success { background-color: #f0a500; border: none; color: #000; }
    .btn-success:hover { background-color: #d18e00; }
    .list-group-item { background: #222; color: #fff; border: 1px solid #444; }
    .logo { display: block; margin: 0 auto 20px; max-width: 150px; }
  </style>
</head>
<body>
<div class="container">
  <img src="logo_scorpions.png" alt="Logo Fight Academy" class="logo">
  <h2 class="text-center mb-4">Registro de Asistencia</h2>

  <?php if ($mensaje): ?>
    <div class="alert alert-info text-center"> <?= $mensaje ?> </div>
    <audio autoplay>
      <source src="<?= $tipo_alerta === 'ok' ? 'ok.mp3' : 'error.mp3' ?>" type="audio/mpeg">
    </audio>
  <?php endif; ?>

  <form method="GET" class="text-center mb-4">
    <label for="rfid" class="form-label fw-bold">Escanear Tarjeta RFID:</label>
    <input type="text" name="rfid" id="rfid" autofocus autocomplete="off" class="form-control text-center" style="max-width: 300px; margin: 10px auto;" required>
    <button type="submit" class="btn btn-success mt-2">Registrar</button>
  </form>

  <h5>🎯 Ingresos de Clientes Hoy</h5>
  <ul class="list-group mb-4">
    <?php while ($row = $asistencias->fetch_assoc()): ?>
      <li class="list-group-item">
        <?= $row['nombre'] . ' ' . $row['apellido'] ?> - <?= date('H:i', strtotime($row['fecha_hora'])) ?> hs - Clases restantes: <?= $row['clases_restantes'] ?>
      </li>
    <?php endwhile; ?>
  </ul>

  <h5>👨‍🏫 Ingresos/Salidas de Profesores Hoy</h5>
  <ul class="list-group">
    <?php while ($p = $ingresos->fetch_assoc()): ?>
      <li class="list-group-item">
        <?= $p['nombre'] . ' ' . $p['apellido'] ?> - Entrada: <?= $p['hora_entrada'] ?> <?= $p['hora_salida'] ? "| Salida: {$p['hora_salida']}" : "| En curso..." ?>
      </li>
    <?php endwhile; ?>
  </ul>
</div>
<script>
  window.onload = function () {
    document.getElementById("rfid").focus();
  };
</script>
</body>
</html>