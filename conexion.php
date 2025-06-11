<?php
$host = 'containers-us-west-104.railway.app'; // O el host público que te da Railway
$puerto = 3306; // o el puerto que figure en MYSQLPORT
$usuario = 'root'; // o MYSQLUSER
$contrasena = 'WkZsWUaTRzG1vXNoSPaabFDyrldIZzMj'; // MYSQL_PASSWORD
$base_datos = 'railway'; // MYSQL_DATABASE

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos, $puerto);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
