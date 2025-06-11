<?php
$host = "tu-host-publico.proxy.rlwy.net"; // Reemplazá esto por el host que tiene `.proxy.rlwy.net`
$usuario = "root"; // O el valor de MYSQLUSER
$contrasena = "WkzZs...rldIzMj"; // Pegá tu MYSQLPASSWORD completo aquí
$basedatos = "railway"; // El valor que aparece en MYSQLDATABASE
$puerto = 41731; // El valor de MYSQLPORT

$conexion = new mysqli($host, $usuario, $contrasena, $basedatos, $puerto);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
