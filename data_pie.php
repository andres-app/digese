<?php
include 'db_config.php';  // Conexión a la base de datos

// Consulta para obtener datos para el gráfico circular
$sql = "SELECT direc, COUNT(*) as count FROM procesos GROUP BY direc";
$result = $conn->query($sql);

$labels = [];
$values = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['direc'];
        $values[] = (int)$row['count'];
    }
}

$conn->close();

// Devolver los datos en formato JSON
echo json_encode(['labels' => $labels, 'values' => $values]);
?>