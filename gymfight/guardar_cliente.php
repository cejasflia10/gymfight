<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $rfid = $_POST['rfid'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];

    // Calcular días disponibles
    $fecha_hoy = new DateTime();
    $fecha_ven = new DateTime($fecha_vencimiento);
    $dias_disponibles = $fecha_ven > $fecha_hoy ? $fecha_ven->diff($fecha_hoy)->days : 0;

    $stmt = $conexion->prepare("INSERT INTO clientes (nombre, apellido, dni, fecha_nacimiento, telefono, email, rfid_uid, fecha_vencimiento, dias_disponibles) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssi", $nombre, $apellido, $dni, $fecha_nacimiento, $telefono, $email, $rfid, $fecha_vencimiento, $dias_disponibles);
    
    if ($stmt->execute()) {
        header("Location: ver_clientes.php?ok=1");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conexion->close();
} else {
    header("Location: agregar_cliente.php");
}
?>
