<?php
$conexion = new mysqli(
  "maglev.proxy.rlwy.net", // 🔁 Cambiá por tu host exacto de Railway
  "root",                                 // Usuario (generalmente es root)
  "WkzZsWUaTRzGlvXWoSPaabFDyrldIzMj",                  // 🔁 Reemplazá con tu contraseña real
  "gymfight",                             // Nombre de la base de datos
  41731                                  // Puerto (por defecto 3306)
);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
