<!-- menu.php actualizado -->
<style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
    transition: background-color 0.3s, color 0.3s;
  }

  .sidebar {
    height: 100%;
    width: 240px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #222;
    padding-top: 60px;
    overflow-y: auto;
    transition: transform 0.3s ease;
    z-index: 900;
  }

  .sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .sidebar li {
    padding: 12px 20px;
  }

  .sidebar a {
    color: white;
    text-decoration: none;
    display: block;
  }

  .sidebar a:hover {
    background-color: #444;
    border-radius: 5px;
  }

  .menu-toggle {
    display: none;
    background-color: #222;
    color: white;
    padding: 10px 20px;
    position: fixed;
    top: 10px;
    left: 10px;
    z-index: 1001;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .dark-mode .sidebar {
    background-color: #111;
  }

  .dark-mode body {
    background-color: #121212;
    color: #eee;
  }

  .dark-mode .main-content {
    background-color: #1e1e1e;
    color: #ddd;
  }

  @media (max-width: 768px) {
    .sidebar {
      transform: translateX(-100%);
    }

    .sidebar.active {
      transform: translateX(0);
    }

    .menu-toggle {
      display: block;
    }

    body.sidebar-open {
      overflow: hidden;
    }
  }

  .main-content {
    margin-left: 240px;
    padding: 20px;
    transition: background-color 0.3s, color 0.3s;
  }

  @media (max-width: 768px) {
    .main-content {
      margin-left: 0;
    }
  }

  .dark-toggle {
    position: fixed;
    top: 10px;
    right: 10px;
    background: #222;
    color: #fff;
    border: none;
    padding: 8px 14px;
    border-radius: 5px;
    cursor: pointer;
    z-index: 1001;
  }

  .dark-mode .dark-toggle {
    background: #555;
  }
</style>

<!-- Botones -->
<button class="menu-toggle" onclick="toggleSidebar()">☰ Menú</button>
<button class="dark-toggle" onclick="toggleDarkMode()">🌙 Modo Oscuro</button>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
  <ul>
    <li><a href="index.php">🏠 Inicio</a></li>
    <li><a href="clientes.php">👥 Clientes</a></li>
    <li><a href="agregar_membresia.php">📅 Membresías</a></li>
    <li><a href="pagos.php">💵 Pagos</a></li>
    <li><a href="registrar_asistencia.php">✅ Asistencia</a></li>
    <li><a href="registrar_clase_realizada.php">📘 Registrar Clase</a></li>
    <li><a href="profesores.php">👨‍🏫 Profesores</a></li>
    <li><a href="listar_profesor.php">📋 Listar Profesores</a></li>
    <li><a href="reporte_horas_trabajadas.php">🕒 Horas Trabajadas</a></li>
    <li><a href="visual_ingresos_salidas.php">📊 Ingresos/Salidas</a></li>

    <li><a href="registro_rfid.php">📲 Escanear RFID</a></li>
    <li><a href="ver_profesores.php">📘 Ver Profesores RFID</a></li>
    <li><a href="reporte_horas_filtro.php">📅 Horas por Mes</a></li>

    <li><a href="logout.php" style="color: #f88;">🚪 Salir</a></li>
  </ul>
</nav>

<!-- Scripts -->
<script>
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
    document.body.classList.toggle('sidebar-open');
  }

  function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
  }

  window.onload = () => {
    if (localStorage.getItem('darkMode') === 'true') {
      document.body.classList.add('dark-mode');
    }
  };
</script>