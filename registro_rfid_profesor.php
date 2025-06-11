<?php
require 'conexion.php';
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['profesor_id']) || !isset($_POST['rfid_uid'])) {
        $mensaje = "Faltan datos obligatorios.";
    } else {
        $profesor_id = $_POST['profesor_id'];
        $rfid_uid = trim($_POST['rfid_uid']);

        $stmt = $mysqli->prepare("UPDATE profesores SET rfid_uid = ? WHERE id = ?");
        $stmt->bind_param("si", $rfid_uid, $profesor_id);

        if ($stmt->execute()) {
            $mensaje = "RFID asignado correctamente al profesor.";
        } else {
            $mensaje = "Error al asignar RFID.";
        }
    }
}

$profesores = $mysqli->query("SELECT id, nombre FROM profesores ORDER BY nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar RFID a Profesor</title>
    <style>
        body {
            background: #1a1a1a;
            color: #eee;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 { color: #f0a500; text-align: center; }
        form {
            max-width: 500px;
            margin: auto;
            background: #222;
            padding: 20px;
            border-radius: 8px;
        }
        label { display: block; margin-top: 15px; }
        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            margin-top: 5px;
            font-size: 1rem;
        }
        button {
            margin-top: 20px;
            background: #f0a500;
            border: none;
            padding: 12px;
            width: 100%;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }
        .mensaje {
            margin-top: 20px;
            padding: 15px;
            text-align: center;
            border-radius: 6px;
            background: #27ae60;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>Asignar RFID a Profesor</h1>

<?php if ($mensaje): ?>
    <div class="mensaje"><?php echo $mensaje; ?></div>
<?php endif; ?>

<form method="POST">
    <label for="profesor_id">Seleccionar Profesor:</label>
    <select name="profesor_id" required>
        <option value="">-- Seleccionar --</option>
        <?php while ($p = $profesores->fetch_assoc()): ?>
            <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?></option>
        <?php endwhile; ?>
    </select>

    <label for="rfid_uid">UID de Tarjeta RFID:</label>
    <input type="text" name="rfid_uid" required placeholder="Ej: 04AABBCC1234">

    <button type="submit">Guardar RFID</button>
</form>

</body>
</html>
