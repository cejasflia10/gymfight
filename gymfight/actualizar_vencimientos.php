<?php
include 'conexion.php';

date_default_timezone_set('America/Argentina/Buenos_Aires');

$clientes = $conexion->query("SELECT id FROM clientes");

while ($cliente = $clientes->fetch_assoc()) {
    $id_cliente = $cliente['id'];

    // Buscar la última membresía activa
    $query = "
        SELECT fecha_vencimiento 
        FROM membresias 
        WHERE cliente_id = $id_cliente 
        ORDER BY fecha_vencimiento DESC 
        LIMIT 1
    ";
    $result = $conexion->query($query);
    $row = $result->fetch_assoc();

    if ($row && $row['fecha_vencimiento']) {
        $fecha_vencimiento = $row['fecha_vencimiento'];
        $hoy = date('Y-m-d');
        $dias_restantes = (strtotime($fecha_vencimiento) - strtotime($hoy)) / 86400;
        $dias_restantes = max(0, intval($dias_restantes));

        // Actualizar campos en la tabla clientes
        $conexion->query("
            UPDATE clientes 
            SET fecha_vencimiento = '$fecha_vencimiento', dias_restantes = $dias_restantes 
            WHERE id = $id_cliente
        ");
    }
}

echo "<h3 style='color: lime;'>✅ Actualización completada correctamente.</h3>";
?>
