<?php
include 'conexion.php';
include 'menu.php';

$clientes = $conexion->query("SELECT id, nombre, apellido FROM clientes ORDER BY apellido");
$productos = $conexion->query("SELECT id, nombre, tipo, precio_venta FROM productos ORDER BY tipo, nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Venta de Productos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container { margin-left: 260px; padding-top: 30px; }
    @media (max-width: 768px) { .container { margin-left: 0; } }
  </style>
</head>
<body class="bg-light">
  <div class="container">
    <h2 class="mb-4 text-center">Registrar Venta de Productos</h2>
    <form action="guardar_venta_producto.php" method="POST" class="bg-white p-4 rounded shadow-sm">

      <!-- Cliente -->
      <div class="mb-3">
        <label for="cliente_id" class="form-label">Cliente:</label>
        <select name="cliente_id" id="cliente_id" class="form-select" required>
          <option value="">Seleccionar cliente...</option>
          <?php while ($c = $clientes->fetch_assoc()): ?>
            <option value="<?= $c['id'] ?>">
              <?= $c['apellido'] . ", " . $c['nombre'] ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- Producto -->
      <div class="mb-3">
        <label for="producto_id" class="form-label">Producto:</label>
        <select name="producto_id" id="producto_id" class="form-select" onchange="actualizarPrecio()" required>
          <option value="">Seleccionar producto...</option>
          <?php while ($p = $productos->fetch_assoc()): ?>
            <option value="<?= $p['id'] ?>" data-precio="<?= $p['precio_venta'] ?>">
              <?= ucfirst($p['tipo']) . ": " . $p['nombre'] . " ($" . number_format($p['precio_venta'], 2) . ")" ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- Fecha -->
      <div class="mb-3">
        <label for="fecha_venta" class="form-label">Fecha de Venta:</label>
        <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" value="<?= date('Y-m-d') ?>" required>
      </div>

      <!-- Método de pago -->
      <div class="mb-3">
        <label for="metodo_pago" class="form-label">Método de Pago:</label>
        <select name="metodo_pago" id="metodo_pago" class="form-select" required>
          <option value="">Seleccionar método...</option>
          <option value="Efectivo">Efectivo</option>
          <option value="Transferencia">Transferencia</option>
          <option value="Cuenta Corriente">Cuenta Corriente</option>
          <option value="Débito">Débito</option>
          <option value="Crédito">Crédito</option>
        </select>
      </div>

      <!-- Total -->
      <div class="mb-3">
        <label class="form-label">Total a Pagar ($):</label>
        <input type="text" name="total" id="total" class="form-control" readonly required>
      </div>

      <button type="submit" class="btn btn-primary">Registrar Venta</button>
      <a href="index.php" class="btn btn-secondary">Volver</a>
    </form>
  </div>

  <script>
    function actualizarPrecio() {
      const select = document.getElementById('producto_id');
      const selected = select.options[select.selectedIndex];
      const precio = selected.getAttribute('data-precio') || 0;
      document.getElementById('total').value = parseFloat(precio).toFixed(2);
    }
  </script>
</body>
</html>
