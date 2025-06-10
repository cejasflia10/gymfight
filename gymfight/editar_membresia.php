<?php
// Conexión directa (puede reemplazar a include("conexion.php"); si da error)
$conexion = new mysqli("localhost", "root", "", "gymfight");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$id = $_GET['id'] ?? null;
$mensaje = "";

if ($id) {
    $stmt = $conexion->prepare("SELECT m.*, c.nombre AS cliente FROM membresias m JOIN clientes c ON m.cliente_id = c.id WHERE m.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $membresia = $resultado->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $clases = $_POST['clases_restantes'] ?? null;

        if (is_numeric($clases)) {
            $stmt = $conexion->prepare("UPDATE membresias SET clases_restantes = ? WHERE id = ?");
            $stmt->bind_param("ii", $clases, $id);
            if ($stmt->execute()) {
                $mensaje = "Clases restantes actualizadas correctamente.";
                $membresia['clases_restantes'] = $clases;
            } else {
                $mensaje = "Error al actualizar.";
            }
        } else {
            $mensaje = "Valor inválido.";
        }
    }
} else {
    die("ID de membresía no válido.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Membresía</title>
<style>
    body {
        background: #121212;
        color: #eee;
        font-family: Arial, sans-serif;
    }
    .main-content {
        padding: 20px;
        max-width: 500px;
        margin: auto;
    }
    h1 {
        color: #f0a500;
    }
    form {
        background: #1e1e1e;
        padding: 20px;
        border-radius: 8px;
    }
    label {
        display: block;
        margin-bottom: 8px;
    }
    input[type="number"] {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        border: none;
        font-size: 16px;
    }
    button {
        padding: 10px 15px;
        border: none;
        background: #f0a500;
        color: #111;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
    }
    .mensaje {
        margin-top: 15px;
        padding: 10px;
        border-radius: 5px;
        background: #27ae60;
        color: white;
    }
</style>
</head>
<body>

<?php include("menu.php"); ?>
<div class="main-content">
    <h1>Editar Membresía de <?= htmlspecialchars($membresia['cliente']) ?></h1>

    <?php if ($mensaje): ?>
        <div class="mensaje"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="POST">
        <label for="clases_restantes">Clases Restantes:</label>
        <input type="number" name="clases_restantes" id="clases_restantes" value="<?= $membresia['clases_restantes'] ?>" min="0" required>
        <button type="submit">Actualizar</button>
    </form>
</div>

</body>
</html>
