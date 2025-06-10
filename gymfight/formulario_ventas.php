<?php
include 'conexion.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];
    $nombre = trim($_POST['nombre']);
    $talle = trim($_POST['talle']);
    $precio_compra = (float)$_POST['precio_compra'];
    $precio_venta = (float)$_POST['precio_venta'];
    $metodo_pago = $_POST['metodo_pago'];

    $stmt = $conexion->prepare("INSERT INTO ventas_productos (tipo, nombre, talle, precio_compra, precio_venta, metodo_pago, fecha) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssssdds", $tipo, $nombre, $talle, $precio_compra, $precio_venta, $metodo_pago);

    if ($stmt->execute()) {
        $mensaje = "✅ Venta registrada correctamente.";
    } else {
        $mensaje = "❌ Error al registrar la venta.";
    }
}
?>

<div class="container py-4">
    <?php if ($mensaje): ?>
        <div class="alert alert-info text-center"> <?= $mensaje ?> </div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">
        <input type="hidden" name="tipo" value="<?= isset($_GET['tipo']) ? htmlspecialchars($_GET['tipo']) : 'protecciones' ?>">

        <div class="mb-3">
            <label class="form-label">Nombre del Producto</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Talle / Oz</label>
            <input type="text" name="talle" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio de Compra</label>
            <input type="number" name="precio_compra" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio de Venta</label>
            <input type="number" name="precio_venta" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Método de Pago</label>
            <select name="metodo_pago" class="form-select" required>
                <option value="">Seleccionar método...</option>
                <option value="Efectivo">Efectivo</option>
                <option value="Transferencia">Transferencia</option>
                <option value="Débito">Débito</option>
                <option value="Crédito">Crédito</option>
                <option value="Cuenta Corriente">Cuenta Corriente</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Venta</button>
    </form>
</div>
