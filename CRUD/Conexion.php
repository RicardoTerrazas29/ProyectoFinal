<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "TechcompanyDB";
$port = 3309;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
