<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Cambia esto por la contraseña de tu base de datos
$dbname = "digese"; // Cambia esto por el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
