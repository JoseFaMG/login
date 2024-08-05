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

// Obtener los datos del formulario
$matricula = $_POST['matricula'];
$nombre = $_POST['nombre'];
$cuatrimestre = intval($_POST['cuatrimestre']);
$correo = $_POST['correo'];
$estado = $_POST['estado'];

// Insertar datos en la base de datos
$sql = "INSERT INTO alumnos (matricula, nombre, cuatrimestre, correo, estado) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiss", $matricula, $nombre, $cuatrimestre, $correo, $estado);

if ($stmt->execute()) {
    echo "Alumno registrado exitosamente";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
header('Location: ../index.html');
?>

