<?php
require 'conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cliente_id = $_POST['cliente_id'] ?? null;
    $membresia_id = $_POST['membresia_id'] ?? null;
    $monto = $_POST['monto'] ?? 0;
    $metodo = $_POST['metodo_pago'] ?? '';

    if ($cliente_id && $membresia_id && $monto > 0 && $metodo) {
        $stmt = $mysqli->prepare("INSERT INTO pagos (cliente_id, membresia_id, monto, metodo_pago, fecha_pago) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("iids", $cliente_id, $membresia_id, $monto, $metodo);
        $stmt->execute();
        $mensaje = "Pago registrado con éxito.";
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}

$clientes = $mysqli->query("SELECT id, nombre, apellido, dni FROM clientes ORDER BY nombre");

// Pre-cargar membresías con nombre del plan
$membresias = [];
if (isset($_POST['cliente_id']) && $_POST['cliente_id']) {
    $cid = $_POST['cliente_id'];
    $res = $mysqli->query("
        SELECT m.id, m.fecha_inicio, m.fecha_vencimiento, t.nombre AS plan
        FROM membresias m
        JOIN tipos_membresia t ON m.plan_id = t.id
        WHERE m.cliente_id = $cid
    ");
    while ($m = $res->fetch_assoc()) {
        $membresias[] = $m;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Pago</title>
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
    form {
      max-width: 500px;
      margin: 0 auto;
      background: #222;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px #000;
    }
    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: none;
      font-size: 1rem;
    }
    button {
      margin-top: 20px;
      background: #f0a500;
      color: #000;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }
    .mensaje {
      text-align: center;
      margin-top: 20px;
      font-weight: bold;
      color: #27ae60;
    }
  </style>
</head>
<body>

<h1>Registrar Pago</h1>

<form method="POST">
  <label for="cliente_id">Seleccionar Cliente:</label>
  <select name="cliente_id" id="cliente_id" required onchange="this.form.submit()">
    <option value="">-- Seleccionar --</option>
    <?php while ($cli = $clientes->fetch_assoc()): ?>
      <option value="<?= $cli['id'] ?>" <?= (isset($_POST['cliente_id']) && $_POST['cliente_id'] == $cli['id']) ? 'selected' : '' ?>>
        <?= htmlspecialchars($cli['nombre']) . " " . htmlspecialchars($cli['apellido']) . " - DNI: " . $cli['dni'] ?>
      </option>
    <?php endwhile; ?>
  </select>

  <?php if (!empty($membresias)): ?>
    <label for="membresia_id">Seleccionar Membresía:</label>
    <select name="membresia_id" id="membresia_id" required>
      <option value="">-- Seleccionar Membresía --</option>
      <?php foreach ($membresias as $m): ?>
        <option value="<?= $m['id'] ?>">
          <?= htmlspecialchars($m['plan']) . " (" . $m['fecha_inicio'] . " a " . $m['fecha_vencimiento'] . ")" ?>
        </option>
      <?php endforeach; ?>
    </select>
  <?php endif; ?>

  <label for="monto">Monto ($):</label>
  <input type="number" step="0.01" name="monto" id="monto" required>

  <label for="metodo_pago">Método de Pago:</label>
  <select name="metodo_pago" id="metodo_pago" required>
    <option value="">-- Seleccionar --</option>
    <option value="Efectivo">Efectivo</option>
    <option value="Transferencia">Transferencia</option>
    <option value="Débito">Débito</option>
    <option value="Crédito">Crédito</option>
    <option value="Cuenta Corriente">Cuenta Corriente</option>
  </select>

  <button type="submit">Registrar Pago</button>
</form>

<?php if ($mensaje): ?>
  <div class="mensaje"><?= $mensaje ?></div>
<?php endif; ?>

</body>
</html>
