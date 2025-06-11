<style>
  body {
    margin: 0;
    padding: 0;
  }
  #menuToggle {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1000;
    background-color: #000;
    color: #FFD700;
    padding: 10px 15px;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
  }

  #sidebar {
    position: fixed;
    top: 0;
    left: 0;
    background-color: #000;
    width: 250px;
    height: 100%;
    overflow-y: auto;
    padding-top: 60px;
    transition: transform 0.3s ease;
    z-index: 999;
    color: #FFD700;
    font-family: Arial, sans-serif;
  }

  #sidebar.hidden {
    transform: translateX(-100%);
  }

  #sidebar a {
    display: block;
    padding: 15px 20px;
    color: #FFD700;
    text-decoration: none;
    border-bottom: 1px solid #333;
    font-size: 16px;
  }

  #sidebar a:hover {
    background-color: #FFD700;
    color: #000;
    font-weight: bold;
  }

  main {
    margin-left: 260px;
    padding: 20px;
  }

  @media (max-width: 768px) {
    main {
      margin-left: 0;
    }
  }
</style>

<div id="menuToggle" onclick="toggleMenu()">☰ Menú</div>

<div id="sidebar">
  <a href="index.php">🏠 Panel Principal</a>
  <a href="clientes.php">👥 Clientes</a>
  <a href="agregar_cliente.php">➕ Agregar Cliente</a>
  <a href="profesores.php">🏋️ Profesores</a>
  <a href="agregar_profesor.php">➕ Agregar Profesor</a>
  <a href="membresias.php">📋 Membresías</a>
  <a href="agregar_membresia.php">➕ Nueva Membresía</a>
  <a href="registrar_asistencia.php">✅ Registrar Asistencia</a>
  <a href="registrar_clase_realizada.php">📆 Registrar Clase</a>
  <a href="planes.php">💼 Planes de Membresía</a>
  <a href="planes_adicionales.php">➕ Planes Adicionales</a>

  <hr style="border-color:#FFD700;">

  <a href="ventas_protecciones.php">🥊 Protecciones</a>
  <a href="ventas_indumentaria.php">👕 Indumentaria</a>
  <a href="ventas_reportes.php">📊 Reportes de Ventas</a>
  <a href="listar_ventas_productos.php">🧾 Lista de Ventas</a>

  <hr style="border-color:#FFD700;">

  <a href="visual_ingresos_salidas.php">👁️ Visual Ingresos/Egresos</a>
  <a href="reporte_horas_trabajadas.php">🕒 Horas Trabajadas</a>
  <a href="clientes_ingresos_mes.php">📅 Ingresos del Mes</a>
</div>

<script>
  function toggleMenu() {
    document.getElementById('sidebar').classList.toggle('hidden');
  }
</script>
