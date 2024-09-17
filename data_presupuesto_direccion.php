<?php
include 'db_config.php';  // Conexión a la base de datos

// Consulta SQL para obtener los montos de presupuesto por dirección
$sql = "SELECT direc, SUM(presupuesto_valor_estimado) AS total_presupuesto
        FROM procesos
        WHERE direc IN ('DEBEDSAR', 'SEHO')  -- Filtrar solo DEBEDSAR y SEHO
        GROUP BY direc";

$result = $conn->query($sql);

$presupuestos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $presupuestos[] = [
            'direccion' => $row['direc'],
            'total_presupuesto' => $row['total_presupuesto']
        ];
    }
}

$conn->close();

// Devolver los datos en formato JSON
echo json_encode($presupuestos);
?>
