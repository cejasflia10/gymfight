<?php
// Leer los parámetros de la base de datos desde variables de entorno
$host = getenv('mysql.railway.internal');
$usuario = getenv('root');
$contraseña = getenv('WkzZsWUaTRzGlvXWoSPaabFDyrldIzMj');
$base_de_datos = getenv('railway');
$puerto = getenv('3306') ?: 3306;

// Crear la conexión
$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos, $puerto);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
