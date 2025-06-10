<?php
include 'conexion.php';

$busqueda = $_GET['buscar'] ?? '';
$estado = $_GET['estado'] ?? '';

$like = '%' . $busqueda . '%';

$where = "WHERE (nombre LIKE ? OR apellido LIKE ? OR dni LIKE ?)";
$parametros = [$like, $like, $like];
$tipos = "sss";

if ($estado === 'Activo' || $estado === 'Inactivo') {
    $where .= " AND estado = ?";
    $parametros[] = $estado;
    $tipos .= "s";
}

$sql = "SELECT * FROM clientes $where ORDER BY apellido";
$stmt = $conexion->prepare($sql);
$stmt->bind_param($tipos, ...$parametros);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<?php include 'menu.php'; ?>

<div class="main-content">
    <h2>👥 Listado de Clientes</h2>

    <form method="get" style="margin-bottom: 20px;">
        <input type="text" name="buscar" placeholder="Buscar por nombre, apellido o DNI" value="<?= htmlspecialchars($busqueda) ?>" />
        <select name="estado">
            <option value="">Todos</option>
            <option value="Activo" <?= $estado === 'Activo' ? 'selected' : '' ?>>Activos</option>
            <option value="Inactivo" <?= $estado === 'Inactivo' ? 'selected' : '' ?>>Inactivos</option>
        </select>
        <button type="submit">🔍 Buscar</button>
    </form>

    <table border="1" width="100%" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($cliente = $resultado->fetch_assoc()): ?>
                <tr style="background: <?= $cliente['estado'] === 'Inactivo' ? '#fee' : '#fff' ?>">
                    <td><?= htmlspecialchars($cliente['apellido'] . ', ' . $cliente['nombre']) ?></td>
                    <td><?= htmlspecialchars($cliente['dni']) ?></td>
                    <td><?= htmlspecialchars($cliente['estado']) ?></td>
                    <td>
                        <a href="editar_cliente.php?id=<?= $cliente['id'] ?>">✏️ Editar</a> |
                        <a href="agregar_membresia.php?cliente_id=<?= $cliente['id'] ?>">➕ Membresía</a> |
                        <a href="historial_asistencias.php?cliente_id=<?= $cliente['id'] ?>">📅 Asistencias</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
