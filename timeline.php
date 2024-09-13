<?php
include 'header.php';
include 'sidebar.php';
include 'db_config.php';  // Conexión a la base de datos
include 'includes.php';   // Incluir estilos y CSS comunes

// Verificar si se ha proporcionado el ID del proceso
if (!isset($_GET['id'])) {
    echo "No se ha proporcionado un ID de proceso.";
    exit;
}

// Obtener el ID del proceso de la URL
$proceso_id = $_GET['id'];

// Consulta para obtener los eventos del proceso
$sql = "SELECT descripcion_evento, fecha_evento, tipo_evento FROM eventos WHERE proceso_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    // Mostrar el error si la preparación de la consulta falla
    echo "Error al preparar la consulta: " . $conn->error;
    exit;
}

$stmt->bind_param('i', $proceso_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    // Mostrar el error si la ejecución de la consulta falla
    echo "Error al ejecutar la consulta: " . $stmt->error;
    exit;
}
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Timeline</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                <li class="breadcrumb-item active">Timeline</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Eventos del Proceso</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-xl-10">
                                    <div class="timeline">
                                        <div class="timeline-container">
                                            <div class="timeline-end">
                                                <p>Start</p>
                                            </div>
                                            <div class="timeline-continue">
                                                <?php 
                                                $counter = 0; // Contador para alternar lados
                                                while ($row = $result->fetch_assoc()): 
                                                    // Alterna las clases entre 'timeline-right' y 'timeline-left'
                                                    $side_class = ($counter % 2 === 0) ? 'timeline-right' : 'timeline-left'; 
                                                ?>
                                                <div class="row <?php echo $side_class; ?>">
                                                    <?php if ($side_class == 'timeline-right'): ?>
                                                    <!-- Mostrar el ícono solo para la derecha -->
                                                    <div class="col-md-6">
                                                        <div class="timeline-icon">
                                                            <i class="bx bx-briefcase-alt-2 text-primary h2 mb-0"></i>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-date bg-primary text-center rounded">
                                                                <h3 class="text-white mb-0"><?php echo date('d', strtotime($row['fecha_evento'])); ?></h3>
                                                                <p class="mb-0 text-white-50"><?php echo date('F', strtotime($row['fecha_evento'])); ?></p>
                                                            </div>
                                                            <div class="event-content">
                                                                <div class="timeline-text">
                                                                    <h3 class="font-size-18"><?php echo htmlspecialchars($row['tipo_evento']); ?></h3>
                                                                    <p class="mb-0 mt-2 pt-1 text-muted"><?php echo htmlspecialchars($row['descripcion_evento']); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php if ($side_class == 'timeline-left'): ?>
                                                    <!-- Mostrar el ícono solo para la izquierda -->
                                                    <div class="col-md-6">
                                                        <div class="timeline-icon">
                                                            <i class="bx bx-briefcase-alt-2 text-primary h2 mb-0"></i>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <?php 
                                                $counter++; // Incrementar el contador para alternar la clase en la siguiente iteración
                                                endwhile; 
                                                ?>
                                            </div>
                                            <div class="timeline-start">
                                                <p>End</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div> <!-- container-fluid -->
    </div> <!-- page-content -->
</div> <!-- main-content -->

<?php 
include 'scripts.php';  // Incluir scripts y JS comunes
include 'footer.php'; 
?>
