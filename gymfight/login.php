<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $usuario = $_POST['usuario'];
  $clave = md5($_POST['clave']);

  $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ? AND clave = ?");
  $stmt->bind_param("ss", $usuario, $clave);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows === 1) {
    $user = $resultado->fetch_assoc();
    $_SESSION['usuario'] = $user['nombre_usuario'];
    $_SESSION['rol'] = $user['rol'];
    header("Location: index.php");
    exit;
  } else {
    $error = "Usuario o contraseña incorrectos.";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body { background: #111; color: #fff; font-family: Arial; text-align: center; margin-top: 100px; }
    input { padding: 10px; margin: 10px; }
    .btn { padding: 10px 20px; background: #f0a500; border: none; color: black; cursor: pointer; }
  </style>
</head>
<body>
  <h2>Iniciar Sesión</h2>
  <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
  <form method="POST">
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="clave" placeholder="Contraseña" required><br>
    <button class="btn" type="submit">Entrar</button>
  </form>
</body>
</html>
