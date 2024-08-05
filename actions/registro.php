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
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$rol = $_POST['rol'];

// Hash de la contraseña
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Preparar y ejecutar la consulta
$sql = "INSERT INTO usuarios (username, password_hash, nombre, apellido, email, rol) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $username, $password_hash, $nombre, $apellido, $email, $rol);

if ($stmt->execute()) {
    echo "Registro exitoso!";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
