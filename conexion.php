<?php
$host = "mysql.railway.internal";     // MYSQLHOST
$usuario = "root";                    // MYSQLUSER
$contraseña = "WkZzSWUaTRzG1vXWoSPaabFDyrlidzMj"; // MYSQLPASSWORD
$base_de_datos = "railway";           // MYSQLDATABASE
$puerto = 3306;                       // MYSQLPORT

$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos, $puerto);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
