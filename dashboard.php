<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php include 'includes.php'; ?> <!-- Incluir el contenido de includes.php -->
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- Header -->
        <?php include 'header.php'; ?>

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Contenido del dashboard -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- Tarjetas informativas -->
                    <div class="row">
                        <!-- Cantidad total de dinero -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Total Presupuesto</h4>
                                    <h2 id="total-presupuesto" class="mb-0">Cargando...</h2>
                                </div>
                            </div>
                        </div>

                        <!-- Cantidad total de procesos -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Total Procesos</h4>
                                    <h2 id="total-procesos" class="mb-0">Cargando...</h2>
                                </div>
                            </div>
                        </div>

                        <!-- Cantidad de procesos por etapa -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Procesos en Requerimiento</h4>
                                    <h2 id="procesos-requerimiento" class="mb-0">Cargando...</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Procesos en Convocatoria</h4>
                                    <h2 id="procesos-convocatoria" class="mb-0">Cargando...</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de gráficos -->
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Gráfico de Barras</h4>
                                    <div id="chart-bar"></div> <!-- Div donde irá el gráfico de barras -->
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Gráfico Circular</h4>
                                    <div id="chart-pie"></div> <!-- Div donde irá el gráfico circular -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- container-fluid -->
            </div> <!-- page-content -->
        </div> <!-- main-content -->

    </div>
    <!-- END layout-wrapper -->

    <?php include 'footer.php'; ?>


</body>
</html>
