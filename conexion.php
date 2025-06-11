<?php
$conexion = new mysqli(
  "maglev.proxy.rlwy.net",             // ✅ HOST correcto (sin NULL)
  "root",                               // Usuario
  "WkZsWUaTRzGlvXWoSPaabFDyrlIdzMJ",   // Contraseña (la real de Railway)
  "railway",                            // Base de datos
  41731                                 // Puerto real de Railway
);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
