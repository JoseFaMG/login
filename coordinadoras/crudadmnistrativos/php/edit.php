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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $user = $_POST['username'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET username = ?, nombre = ?, apellido = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $user, $nombre, $apellido, $email, $id);

    if ($stmt->execute()) {
        header('Location: ../usuarios.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
