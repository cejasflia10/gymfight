<?php
include 'conexion.php';
include 'menu.php';

// Obtener productos y clientes
$productos = $conexion->query("SELECT id, nombre, tipo, precio_venta FROM productos ORDER BY nombre");
$clientes = $conexion->query("SELECT id, nombre, apellido FROM clientes ORDER BY apellido");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Venta de Producto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f4f4f4; font-family: Arial, sans-serif; }
    .container { margin-left: 260px; padding: 30px; }
    .card { box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    @media (max-width: 768px) { .container { margin-left: 0; } }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mb-4 text-center text-warning">Registrar Venta de Producto</h2>

    <form action="guardar_venta_producto.php" method="POST" class="card p-4 bg-white">
      <!-- Cliente -->
      <div class="mb-3">
        <label class="form-label">Cliente:</label>
        <select name="cliente_id" class="form-select" required>
          <option value="">Seleccionar cliente...</option>
          <?php while ($c = $clientes->fetch_assoc()): ?>
            <option value="<?= $c['id'] ?>">
              <?= $c['apellido'] . ', ' . $c['nombre'] ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- Producto -->
      <div class="mb-3">
        <label class="form-label">Producto:</label>
        <select name="producto_id" id="producto_id" class="form-select" onchange="actualizarPrecio()" required>
          <option value="">Seleccionar producto...</option>
          <?php while ($p = $productos->fetch_assoc()): ?>
            <option value="<?= $p['id'] ?>" data-precio="<?= $p['precio_venta'] ?>">
              <?= strtoupper($p['tipo']) . ' - ' . $p['nombre'] . ' ($' . number_format($p['precio_venta'], 2) . ')' ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- Precio de venta -->
      <div class="mb-3">
        <label class="form-label">Precio de Venta ($):</label>
        <input type="text" class="form-control" id="precio_venta" name="precio_venta" readonly required>
      </div>

      <!-- Método de pago -->
      <div class="mb-3">
        <label class="form-label">Método de Pago:</label>
        <select name="metodo_pago" class="form-select" required>
          <option value="">Seleccionar método...</option>
          <option value="Efectivo">Efectivo</option>
          <option value="Débito">Débito</option>
          <option value="Transferencia">Transferencia</option>
          <option value="Crédito">Tarjeta Crédito</option>
          <option value="Cuenta Corriente">Cuenta Corriente</option>
        </select>
      </div>

      <!-- Fecha de venta -->
      <div class="mb-3">
        <label class="form-label">Fecha de Venta:</label>
        <input type="date" name="fecha_venta" class="form-control" value="<?= date('Y-m-d') ?>" required>
      </div>

      <button type="submit" class="btn btn-success">Registrar Venta</button>
      <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>

  <script>
    function actualizarPrecio() {
      const select = document.getElementById("producto_id");
      const selected = select.options[select.selectedIndex];
      const precio = selected.getAttribute("data-precio");
      document.getElementById("precio_venta").value = precio;
    }
  </script>
</body>
</html>
