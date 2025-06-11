<?php
include 'conexion.php';
include 'menu.php';

$resultado = $conexion->query("SELECT * FROM profesores ORDER BY apellido, nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Profesores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .container { margin-left: 260px; padding-top: 30px; }
        @media (max-width: 768px) {
            .container { margin-left: 0; }
        }
    </style>
</head>
<body class="bg-light">
<div class="container">
    <h2 class="mb-4 text-center">Listado de Profesores</h2>

    <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-light">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($profesor = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($profesor['nombre']) ?></td>
                    <td><?= htmlspecialchars($profesor['apellido']) ?></td>
                    <td><?= htmlspecialchars($profesor['dni']) ?></td>
                    <td><?= htmlspecialchars($profesor['telefono']) ?></td>
                    <td>
                        <a href="editar_profesor.php?id=<?= $profesor['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            <?php if ($resultado->num_rows === 0): ?>
                <tr><td colspan="5" class="text-center">No hay profesores registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
