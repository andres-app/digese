<?php
include 'header.php';
include 'sidebar.php';
include 'db_config.php';  // Conexión a la base de datos
include 'includes.php';   // Incluir estilos y CSS comunes

// Consulta para obtener los datos de los procesos, incluyendo el campo 'id'
$sql = "SELECT id, sinad, direc, grupo, obtencion, nombre, estado_actual, fecha_inicio FROM procesos";
$result = $conn->query($sql);
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Título de la página -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Lista de Procesos</h4>
                    </div>
                </div>
            </div>

            <!-- Tabla con DataTables -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Procesos de Compra</h4>

                            <!-- Contenedor con clase table-responsive para habilitar el scroll horizontal -->
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <!-- Dentro de la tabla donde se listan los procesos -->
                                    <thead>
                                        <tr>
                                            <th>Número de SINAD</th>
                                            <th>Dirección</th>
                                            <th>Grupo</th>
                                            <th>Obtención</th>
                                            <th>Nombre</th>
                                            <th>Estado Actual</th>
                                            <th>Fecha de Inicio</th>
                                            <th>Acciones</th> <!-- Nueva columna para las acciones -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                <td>{$row['sinad']}</td>
                <td>{$row['direc']}</td>
                <td>{$row['grupo']}</td>
                <td>{$row['obtencion']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['estado_actual']}</td>
                <td>{$row['fecha_inicio']}</td>
                <td><a href='timeline.php?id={$row['id']}' class='btn btn-primary btn-sm'>Ver Timeline</a></td> <!-- Enlace al timeline -->
            </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>No hay procesos disponibles</td></tr>";
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div> <!-- End table-responsive -->

                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- page-content -->
</div> <!-- main-content -->

<?php
include 'footer.php';
?>
