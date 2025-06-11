<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = $_POST['producto_id'];
    $tipo = $_POST['tipo']; // proteccion o indumentaria
    $metodo_pago = $_POST['metodo_pago'];
    $fecha = date('Y-m-d H:i:s');

    $tabla = $tipo === 'proteccion' ? 'protecciones' : 'indumentaria';

    // Obtener precio de venta del producto
    $stmt = $conexion->prepare("SELECT precio_venta FROM $tabla WHERE id = ?");
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();
    $monto = $producto['precio_venta'];

    // Guardar la venta
    $stmt = $conexion->prepare("INSERT INTO ventas_productos (producto_id, tipo, metodo_pago, monto, fecha) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issds", $producto_id, $tipo, $metodo_pago, $monto, $fecha);

    if ($stmt->execute()) {
        header("Location: ventas_productos.php?ok=1");
    } else {
        header("Location: ventas_productos.php?error=1");
    }
    exit;
}
?>
