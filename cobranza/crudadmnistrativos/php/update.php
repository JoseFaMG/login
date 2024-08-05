<?php
session_start();
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];

    // Verificar si se proporcionó una nueva contraseña
    if (!empty($_POST['password'])) {
        $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $sql = "UPDATE usuarios SET username = ?, nombre = ?, apellido = ?, email = ?, password_hash = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $username, $nombre, $apellido, $email, $password_hash, $id);
    } else {
        $sql = "UPDATE usuarios SET username = ?, nombre = ?, apellido = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $username, $nombre, $apellido, $email, $id);
    }

    if ($stmt->execute()) {
        echo "Usuario actualizado exitosamente";
    } else {
        echo "Error actualizando el usuario: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
