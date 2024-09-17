<?php
include 'db_config.php';  // Conexión a la base de datos

// Consulta para obtener datos para el gráfico de barras
$sql = "SELECT nombre, cant_items FROM procesos";
$result = $conn->query($sql);

$categories = [];
$values = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['nombre'];
        $values[] = (int)$row['cant_items'];
    }
}

$conn->close();

// Devolver los datos en formato JSON
echo json_encode(['categories' => $categories, 'values' => $values]);
?>