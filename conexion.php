<?php
$host = "mysql-railway.internal"; // nombre exacto que te dio Railway
$usuario = "root";               // usuario (lo vi en tu captura)
$contraseña = "WkZzSWUaTRzG1vXWoSPaabFDyr1dIzMj"; // tu contraseña real de Railway
$base_de_datos = "railway";      // nombre de la base de datos
$puerto = 3306;                  // puerto estándar

$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos, $puerto);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
