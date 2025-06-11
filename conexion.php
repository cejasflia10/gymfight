<?php
$host = getenv(mysql.railway.internal);
$usuario = getenv(root);
$contraseña = getenv(WkzZsWUaTRzGlvXWoSPaabFDyrldIzMj);
$base_de_datos = getenv(railway);

$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
