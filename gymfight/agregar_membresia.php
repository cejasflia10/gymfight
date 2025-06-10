<?php
include 'conexion.php';
include 'menu.php';

$planes = $conexion->query("SELECT id, nombre, clases, monto FROM tipos_membresia ORDER BY nombre");
$adicionales = $conexion->query("SELECT id, nombre, monto FROM planes_adicionales ORDER BY nombre");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Membresía</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #111; color: #eee; }
    .container { margin-left: 250px; padding: 30px; max-width: 800px; }
    label { font-weight: bold; }
    h2 { color: #f0a500; margin-bottom: 20px; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Registrar Nueva Membresía</h2>
    <form action="guardar_membresia.php" method="POST" class="bg-dark p-4 rounded shadow">
      <div class="mb-3">
        <label for="cliente_busqueda">Buscar Cliente:</label>
        <input type="text" id="cliente_busqueda" class="form-control" placeholder="Nombre, apellido o DNI" autocomplete="off">
        <input type="hidden" name="cliente_id" id="cliente_id" required>
        <div id="resultados" class="list-group mt-1"></div>
      </div>
      <div class="mb-3">
        <label for="plan_id">Plan de Membresía:</label>
        <select name="plan_id" id="plan_id" class="form-select" onchange="actualizarMonto()" required>
          <option value="">Seleccionar plan...</option>
          <?php while ($p = $planes->fetch_assoc()): ?>
            <option value="<?= $p['id'] ?>" data-monto="<?= $p['monto'] ?>">
              <?= $p['nombre'] . " - $" . number_format($p['monto'], 2) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="<?= date('Y-m-d') ?>" required>
      </div>
      <div class="mb-3">
        <label for="metodo_pago">Método de Pago:</label>
        <select name="metodo_pago" id="metodo_pago" class="form-select" required>
          <option value="">Seleccionar método...</option>
          <option value="Efectivo">Efectivo</option>
          <option value="Transferencia">Transferencia</option>
          <option value="Débito">Débito</option>
          <option value="Crédito">Crédito</option>
          <option value="Cuenta Corriente">Cuenta Corriente</option>
        </select>
      </div>
      <div class="mb-3">
        <label>Alquileres / Adicionales:</label><br>
        <?php while ($a = $adicionales->fetch_assoc()): ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input adicional" type="checkbox" name="adicionales[]" value="<?= $a['id'] ?>" data-monto="<?= $a['monto'] ?>">
            <label class="form-check-label"><?= $a['nombre'] . " ($" . number_format($a['monto'], 2) . ")" ?></label>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="mb-3">
        <label>Monto Plan:</label>
        <input type="text" id="monto_plan" class="form-control" readonly>
      </div>
      <div class="mb-3">
        <label>Monto Total:</label>
        <input type="text" name="monto_pagado" id="monto_total" class="form-control" readonly required>
      </div>
      <button type="submit" class="btn btn-primary">Guardar Membresía</button>
      <a href="membresias.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
  <script>
    document.getElementById('cliente_busqueda').addEventListener('input', function () {
      const valor = this.value;
      if (valor.length < 2) {
        document.getElementById('resultados').innerHTML = '';
        return;
      }
      fetch("buscar_cliente.php?termino=" + encodeURIComponent(valor))
        .then(r => r.json())
        .then(data => {
          const lista = data.map(cliente => `
            <button type="button" class="list-group-item list-group-item-action" data-id="${cliente.id}">${cliente.texto}</button>
          `).join('');
          document.getElementById('resultados').innerHTML = lista;
          document.querySelectorAll('#resultados button').forEach(btn => {
            btn.addEventListener('click', () => {
              document.getElementById('cliente_busqueda').value = btn.textContent;
              document.getElementById('cliente_id').value = btn.dataset.id;
              document.getElementById('resultados').innerHTML = '';
            });
          });
        });
    });
    function actualizarMonto() {
      const plan = document.getElementById("plan_id");
      const montoBase = parseFloat(plan.options[plan.selectedIndex]?.dataset.monto || 0);
      document.getElementById("monto_plan").value = montoBase.toFixed(2);
      let adicionales = document.querySelectorAll(".adicional:checked");
      let adicionalTotal = 0;
      adicionales.forEach(a => adicionalTotal += parseFloat(a.dataset.monto || 0));
      document.getElementById("monto_total").value = (montoBase + adicionalTotal).toFixed(2);
    }
    document.querySelectorAll(".adicional").forEach(input => {
      input.addEventListener("change", actualizarMonto);
    });
  </script>
</body>
</html>
