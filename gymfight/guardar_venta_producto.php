<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST['cliente_id'];
    $producto_id = $_POST['producto_id'];
    $fecha_venta = $_POST['fecha_venta'];
    $metodo_pago = $_POST['metodo_pago'];
    $total = $_POST['total'];

    $stmt = $conexion->prepare("INSERT INTO ventas_productos (cliente_id, producto_id, fecha_venta, metodo_pago, total) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iissd", $cliente_id, $producto_id, $fecha_venta, $metodo_pago, $total);

    if ($stmt->execute()) {
        echo "<script>
                alert('Venta registrada correctamente.');
                window.location.href = 'ventas_productos.php';
              </script>";
    } else {
        echo "Error al registrar la venta: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Acceso no permitido.";
}
?>
