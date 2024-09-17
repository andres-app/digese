<!-- sidebar.php -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluye estilos y scripts comunes
include 'includes.php';
?>

<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!-- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="dashboard.php">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Procesos</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="lista_procesos.php" data-key="t-lista-procesos">Lista de procesos</a></li>
                        <li><a href="apps-chat.html" data-key="t-chat">Chat</a></li>
                        <!-- Añade más enlaces aquí -->
                    </ul>
                </li>

                <!-- Añade más secciones del menú aquí -->

            </ul>
            <!-- Sidebar -->
        </div>
    </div>
</div>