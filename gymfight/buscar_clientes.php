<?php
include 'conexion.php';

$termino = $_GET['termino'] ?? '';

if ($termino !== '') {
  $stmt = $conexion->prepare("SELECT id, nombre, apellido, dni FROM clientes WHERE nombre LIKE CONCAT('%', ?, '%') OR apellido LIKE CONCAT('%', ?, '%') OR dni LIKE CONCAT('%', ?, '%') LIMIT 10");
  $stmt->bind_param("sss", $termino, $termino, $termino);
  $stmt->execute();
  $resultado = $stmt->get_result();

  $clientes = [];
  while ($c = $resultado->fetch_assoc()) {
    $clientes[] = [
      'id' => $c['id'],
      'texto' => $c['apellido'] . ", " . $c['nombre'] . " - DNI " . $c['dni']
    ];
  }

  header('Content-Type: application/json');
  echo json_encode($clientes);
}
