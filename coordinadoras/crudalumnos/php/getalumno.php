<?php
$servername = "localhost";
$username = "root";
$password = "2017452071";
$dbname = "controldeacceso";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del alumno
$id = $_GET['id'];

// Obtener datos del alumno de la base de datos
$sql = "SELECT * FROM alumnos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $alumno = $result->fetch_assoc();
    echo json_encode($alumno);
} else {
    echo json_encode([]);
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
