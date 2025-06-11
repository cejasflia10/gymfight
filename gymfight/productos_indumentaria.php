<?php
include 'conexion.php';
include 'menu.php';

$mensaje = "";

if (isset($_GET['eliminar'])) {
    $id = (int)$_GET['eliminar'];
    $conexion->query("DELETE FROM productos_indumentaria WHERE id = $id");
    $mensaje = "Producto eliminado.";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $talle = $_POST['talle'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];

    $stmt = $conexion->prepare("INSERT INTO productos_indumentaria (nombre, talle, precio_compra, precio_venta) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdd", $nombre, $talle, $precio_compra, $precio_venta);
    $stmt->execute();
    $mensaje = "Producto agregado.";
}

$productos = $conexion->query("SELECT * FROM productos_indumentaria ORDER BY nombre");
?>

<div class="container mt-4">
  <h2 class="mb-4">Productos - Indumentaria</h2>
  <?php if ($mensaje): ?>
    <div class="alert alert-success"><?= $mensaje ?></div>
  <?php endif; ?>

  <form method="POST" class="mb-4 row g-2">
    <div class="col-md-3"><input type="text" name="nombre" placeholder="Nombre" class="form-control" required></div>
    <div class="col-md-2"><input type="text" name="talle" placeholder="Talle" class="form-control" required></div>
    <div class="col-md-2"><input type="number" name="precio_compra" placeholder="Compra" class="form-control" step="0.01" required></div>
    <div class="col-md-2"><input type="number" name="precio_venta" placeholder="Venta" class="form-control" step="0.01" required></div>
    <div class="col-md-3"><button class="btn btn-primary w-100">Agregar Producto</button></div>
  </form>

  <table class="table table-bordered">
    <thead><tr><th>Nombre</th><th>Talle</th><th>Compra</th><th>Venta</th><th>Acciones</th></tr></thead>
    <tbody>
      <?php while($p = $productos->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($p['nombre']) ?></td>
          <td><?= htmlspecialchars($p['talle']) ?></td>
          <td>$<?= number_format($p['precio_compra'], 2) ?></td>
          <td>$<?= number_format($p['precio_venta'], 2) ?></td>
          <td><a href="?eliminar=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</a></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
