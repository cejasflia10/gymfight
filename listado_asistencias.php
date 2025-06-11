<?php
$mysqli = new mysqli("localhost", "root", "", "gymfight");
if ($mysqli->connect_errno) {
    die("Error en conexión: " . $mysqli->connect_error);
}

$query = "SELECT a.id, c.nombre, c.dni, a.fecha_hora 
          FROM asistencias a
          JOIN clientes c ON a.cliente_id = c.id
          ORDER BY a.fecha_hora DESC";

$resultado = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Listado de Asistencias - Fight Academy Scorpions</title>
<style>
    body { font-family: Arial, sans-serif; background:#f9f9f9; color:#333; padding: 20px; }
    h1 { color: #f0a500; text-align:center; }
    table { border-collapse: collapse; width: 100%; max-width: 900px; margin: 20px auto; background: #fff; }
    th, td { padding: 12px; border: 1px solid #ccc; text-align: left; }
    th { background-color: #f0a500; color: #fff; }
    tr:nth-child(even) { background-color: #f2f2f2; }
</style>
</head>
<body>

<h1>Listado General de Asistencias</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Fecha y Hora</th>
        </tr>
    </thead>
    <tbody>
        <?php if($resultado && $resultado->num_rows > 0): ?>
            <?php while($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($fila['dni']); ?></td>
                    <td><?php echo date("d/m/Y H:i", strtotime($fila['fecha_hora'])); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4" style="text-align:center;">No hay asistencias registradas.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
