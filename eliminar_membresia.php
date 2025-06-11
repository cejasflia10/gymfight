<?php
$conexion = new mysqli("localhost", "root", "", "gymfight");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conexion->prepare("DELETE FROM membresias WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: membresias.php");
    exit;
} else {
    echo "ID no válido.";
}
?>
