<?php
include 'conexion.php';
include 'menu.php';

$mensaje = "";

// Eliminar producto
if (isset($_GET['eliminar'])) {
    $id = (int) $_GET['eliminar'];
    $conexion->query("DELETE FROM productos WHERE id = $id AND tipo = 'indumentaria'");
    $mensaje = "✅ Producto eliminado correctamente.";
}

// Obtener lista de productos tipo indumentaria
$productos = $conexion->query("SELECT * FROM productos WHERE tipo = 'indumentaria' ORDER BY nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Ventas - Indumentaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #121212;
            color: #eee;
        }
        .container {
            margin-left: 260px;
            padding-top: 30px;
            max-width: 1000px;
        }
        @media (max-width: 768px) {
            .container {
                margin-left: 0;
            }
        }
        h2 {
            color: #f0a500;
            text-align: center;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #f0a500;
            color: #111;
        }
        .btn-agregar {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }
        .btn-agregar:hover {
            background-color: #218838;
        }
        .btn-editar {
            background-color: #ffc107;
            color: #111;
        }
        .btn-eliminar {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>👕 Ventas de Indumentaria</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-success text-center"><?= $mensaje ?></div>
    <?php endif; ?>

    <div class="mb-3 text-end">
        <a href="agregar_producto.php?tipo=indumentaria" class="btn btn-agregar">➕ Agregar Nuevo Producto</a>
    </div>

    <table class="table table-dark table-striped text-center">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Talle</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($productos->num_rows > 0): ?>
                <?php while ($row = $productos->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><?= htmlspecialchars($row['talle']) ?></td>
                        <td>$<?= number_format($row['precio_compra'], 2) ?></td>
                        <td>$<?= number_format($row['precio_venta'], 2) ?></td>
                        <td>
                            <a href="editar_producto.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-editar">Editar</a>
                            <a href="ventas_indumentaria.php?eliminar=<?= $row['id'] ?>" class="btn btn-sm btn-eliminar" onclick="return confirm('¿Eliminar producto?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">No hay productos registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
