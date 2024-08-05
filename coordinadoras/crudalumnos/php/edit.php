<?php
$servername = "localhost";
$username = "root";
$password = "2017452071";
$dbname = "controldeacceso";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM alumnos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 1) {
        $alumno = $result->fetch_assoc();
        echo json_encode($alumno);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
} else {
    $sql = "SELECT * FROM alumnos";
    $result = $conn->query($sql);
    $alumnos = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $alumnos[] = $row;
        }
    }

    echo json_encode($alumnos);
}

$conn->close();
?>
