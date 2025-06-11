<?php
// Variables obtenidas desde Railway
$host = "mysql-railway.internal"; // MYSQLHOST
$usuario = "root"; // MYSQLUSER
$contrasena = "WkzZsWUaTRzGlvXWoSPaabFDyrl dIzMj"; // MYSQLPASSWORD (verificá que no tenga espacios al copiar)
$base_datos = "railway"; // MYSQLDATABASE
$puerto = 3306; // MYSQLPORT

// Crear conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos, $puerto);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
