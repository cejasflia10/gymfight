<?php
$host = "maglev.proxy.rlwy.net"; // Tu host de Railway (.proxy.rlwy.net)
$usuario = "root"; // Usuario Railway
$contrasena = "WkzZsWUaTRzGlvXWoSPaabFDyrldIzMj"; // Contraseña real de tu base
$basedatos = "railway"; // Nombre exacto de la base
$puerto = 41731; // Puerto real (ejemplo)

$conexion = new mysqli($host, $usuario, $contrasena, $basedatos, $puerto);

if ($conexion->connect_error) {
    die("❌ Conexión fallida: " . $conexion->connect_error);
}
echo "✅ Conexión exitosa a Railway desde Render.";
?>
