<?php
$host = "maglev.proxy.rlwy.net"; // Host público de Railway
$usuario = "root"; // Usuario Railway
$contrasena = "WkzZsWUaTRzGlvXWoSPaabFDyrldIzMj"; // Contraseña real
$basedatos = "railway"; // Nombre de la base
$puerto = 41731; // Puerto Railway (fijate si este es el tuyo)

$conexion = new mysqli($host, $usuario, $contrasena, $basedatos, $puerto);

if ($conexion->connect_error) {
    die("❌ Conexión fallida: " . $conexion->connect_error);
}
?>

