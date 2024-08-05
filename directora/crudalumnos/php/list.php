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

$id = isset($_GET['id']) ? $_GET['id'] : null;
$query = isset($_GET['q']) ? $_GET['q'] : '';

if ($id !== null) {
    $sql = "SELECT * FROM alumnos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $alumno = $result->fetch_assoc();
    echo json_encode($alumno);
} elseif ($query !== '') {
    $sql = "SELECT * FROM alumnos WHERE matricula LIKE ? OR nombre LIKE ? OR correo LIKE ?";
    $likeQuery = '%' . $query . '%';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $likeQuery, $likeQuery, $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();
    $alumnos = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($alumnos);
} else {
    $sql = "SELECT * FROM alumnos";
    $result = $conn->query($sql);
    $alumnos = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $alumnos[] = $row;
        }
    }

    echo json_encode($alumnos);
}

$conn->close();
?>
