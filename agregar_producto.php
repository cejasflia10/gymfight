<?php
include 'conexion.php';
include 'menu.php';

$tipo = $_GET['tipo'] ?? '';
$tipo_valido = in_array($tipo, ['proteccion', 'indumentaria']);

if (!$tipo_valido) {
    die("Tipo inválido. Debe ser 'proteccion' o 'indumentaria'.");
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"]);
    $talle = trim($_POST["talle"]);
    $precio_compra = floatval($_POST["precio_compra"]);
    $precio_venta = floatval($_POST["precio_venta"]);

    if ($nombre && $talle && $precio_compra >= 0 && $precio_venta >= 0) {
        $stmt = $conexion->prepare("INSERT INTO productos (nombre, talle, precio_compra, precio_venta, tipo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdds", $nombre, $talle, $precio_compra, $precio_venta, $tipo);
        if ($stmt->execute()) {
            $mensaje = "✅ Producto agregado correctamente.";
        } else {
            $mensaje = "❌ Error al guardar: " . $conexion->error;
        }
    } else {
        $mensaje = "❌ Complete todos los campos correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #eee;
        }
        .container {
            margin-left: 260px;
            padding-top: 30px;
            max-width: 700px;
        }
        @media (max-width: 768px) {
            .container {
                margin-left: 0;
            }
        }
        h2 {
            text-align: center;
            color: #f0a500;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #f0a500;
            border: none;
        }
        .btn-primary:hover {
            background-color: #cf8c00;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>➕ Agregar Producto de <?= ucfirst($tipo) ?></h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-info text-center"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-dark p-4 rounded shadow">
        <div class="mb-3">
            <label class="form-label">Nombre del Producto</label>
            <input type="text" name="nombre" class="form-control" required maxlength="100">
        </div>
        <div class="mb-3">
            <label class="form-label">Talle / Oz</label>
            <input type="text" name="talle" class="form-control" required maxlength="20">
        </div>
        <div class="mb-3">
            <label class="form-label">Precio de Compra ($)</label>
            <input type="number" name="precio_compra" step="0.01" min="0" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio de Venta ($)</label>
            <input type="number" name="precio_venta" step="0.01" min="0" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="ventas_<?= $tipo ?>.php" class="btn btn-secondary">← Volver</a>
            <button type="submit" class="btn btn-primary">Guardar Producto</button>
        </div>
    </form>
</div>
</body>
</html>
