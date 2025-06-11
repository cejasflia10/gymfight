<?php
include 'conexion.php';

// PROCESAR CSV SI SE ENVÍA
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo_csv'])) {
    $archivo_tmp = $_FILES['archivo_csv']['tmp_name'];
    $nombre_archivo = $_FILES['archivo_csv']['name'];

    if (($archivo = fopen($archivo_tmp, "r")) !== FALSE) {
        fgetcsv($archivo, 1000, ";"); // Salta encabezado

        $clientes_nuevos = 0;
        $clientes_existentes = 0;

        while (($datos = fgetcsv($archivo, 1000, ";")) !== FALSE) {
            if (count($datos) < 5) {
                echo "Fila con columnas incompletas. Saltando...<br>";
                continue;
            }

            $dni = trim($datos[0]);
            $nombre = trim($datos[1]);
            $apellido = trim($datos[2]);
            $telefono = trim($datos[3]);
            $email = trim($datos[4]);

            $consulta = $conexion->prepare("SELECT id FROM clientes WHERE dni = ?");
            $consulta->bind_param("s", $dni);
            $consulta->execute();
            $resultado = $consulta->get_result();

            if ($resultado->num_rows > 0) {
                $clientes_existentes++;
            } else {
                $insertar = $conexion->prepare("INSERT INTO clientes (dni, nombre, apellido, telefono, email) VALUES (?, ?, ?, ?, ?)");
                $insertar->bind_param("sssss", $dni, $nombre, $apellido, $telefono, $email);
                $insertar->execute();
                $clientes_nuevos++;
            }
        }

        fclose($archivo);
        echo "<p>$clientes_nuevos clientes nuevos agregados.</p>";
        echo "<p>$clientes_existentes clientes ya existían.</p>";
    } else {
        echo "<p>No se pudo abrir el archivo.</p>";
    }
}
?>

<!-- FORMULARIO HTML -->
<h2>Importar clientes desde CSV</h2>
<form action="importar_clientes.php" method="POST" enctype="multipart/form-data">
    <label for="archivo_csv">Seleccioná un archivo CSV:</label>
    <input type="file" name="archivo_csv" accept=".csv" required>
    <br><br>
    <button type="submit">Importar</button>
</form>
