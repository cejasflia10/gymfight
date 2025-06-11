<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $telefono = $_POST["telefono"];
    $rfid_uid = $_POST["rfid_uid"];

    $stmt = $conexion->prepare("UPDATE profesores SET nombre=?, apellido=?, dni=?, telefono=?, rfid_uid=? WHERE id=?");
    $stmt->bind_param("sssssi", $nombre, $apellido, $dni, $telefono, $rfid_uid, $id);

    if ($stmt->execute()) {
        header("Location: listar_profesor.php?mensaje=actualizado");
        exit();
    } else {
        echo "❌ Error al actualizar el profesor: " . $conexion->error;
    }
} else {
    echo "Acceso no permitido.";
}
