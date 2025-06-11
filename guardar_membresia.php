<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST['cliente_id'];
    $plan_id = $_POST['plan_id'];
    $metodo_pago = $_POST['metodo_pago'];
    $monto_pagado = $_POST['monto_pagado'];

    // Fecha actual como fecha de inicio
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha_inicio = date('Y-m-d');

    // Obtener cantidad de clases del plan
    $stmt = $conexion->prepare("SELECT clases FROM tipos_membresia WHERE id = ?");
    $stmt->bind_param("i", $plan_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $clases_restantes = 0;
    if ($fila = $resultado->fetch_assoc()) {
        $clases_restantes = $fila['clases'];
    }
    $stmt->close();

    // Calcular vencimiento (1 mes después)
    $fecha_vencimiento = date('Y-m-d', strtotime($fecha_inicio . ' +1 month'));
    $fecha_fin = $fecha_vencimiento;

    // Insertar membresía
    $stmt = $conexion->prepare("INSERT INTO membresias 
        (cliente_id, plan_id, fecha_inicio, fecha_vencimiento, fecha_fin, monto_pagado, metodo_pago, clases_restantes) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssssi", $cliente_id, $plan_id, $fecha_inicio, $fecha_vencimiento, $fecha_fin, $monto_pagado, $metodo_pago, $clases_restantes);
    
    if ($stmt->execute()) {
        $membresia_id = $stmt->insert_id;

        // Insertar adicionales si hay
        if (!empty($_POST['adicionales'])) {
            foreach ($_POST['adicionales'] as $adicional_id) {
                $stmt_ad = $conexion->prepare("INSERT INTO membresias_adicionales (membresia_id, adicional_id) VALUES (?, ?)");
                $stmt_ad->bind_param("ii", $membresia_id, $adicional_id);
                $stmt_ad->execute();
                $stmt_ad->close();
            }
        }

        header("Location: membresias.php?ok=1");
        exit;
    } else {
        echo "Error al guardar membresía: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    header("Location: agregar_membresia.php");
    exit;
}
?>
