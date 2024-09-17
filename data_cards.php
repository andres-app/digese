<?php
include 'db_config.php';  // Conexión a la base de datos

// Calcular el total de presupuesto
$sql = "SELECT SUM(presupuesto_valor_estimado) AS total_presupuesto FROM procesos";
$result = $conn->query($sql);
$total_presupuesto = $result->fetch_assoc()['total_presupuesto'] ?? 0;

// Calcular el total de procesos
$sql = "SELECT COUNT(*) AS total_procesos FROM procesos";
$result = $conn->query($sql);
$total_procesos = $result->fetch_assoc()['total_procesos'] ?? 0;

// Calcular la cantidad de procesos en la etapa "FECHA DE REQUERIMIENTO"
$sql = "SELECT COUNT(*) AS procesos_requerimiento FROM eventos WHERE tipo_evento = 'FECHA DE REQUERIMIENTO'";
$result = $conn->query($sql);
$procesos_requerimiento = $result->fetch_assoc()['procesos_requerimiento'] ?? 0;

// Calcular la cantidad de procesos en la etapa "FECHA DE CONVOCATORIA"
$sql = "SELECT COUNT(*) AS procesos_convocatoria FROM eventos WHERE tipo_evento = 'FECHA DE CONVOCATORIA'";
$result = $conn->query($sql);
$procesos_convocatoria = $result->fetch_assoc()['procesos_convocatoria'] ?? 0;

$conn->close();

// Devolver los datos en formato JSON
echo json_encode([
    'total_presupuesto' => $total_presupuesto,
    'total_procesos' => $total_procesos,
    'procesos_requerimiento' => $procesos_requerimiento,
    'procesos_convocatoria' => $procesos_convocatoria
]);
?>
