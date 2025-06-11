<?php
$host = "mysql-railway.internal";
$usuario = "root";
$contraseña = "WkZzSWUaTRzG1vXWoSPaabFDyr1dIzMj";
$base_de_datos = "railway";
$puerto = 3306;

$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos, $puerto);
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
