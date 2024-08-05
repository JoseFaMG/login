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
    // Recoger los datos del formulario
    $id = $_POST['id'];
    $matricula = $_POST['matricula'];
    $nombre = $_POST['nombre'];
    $cuatrimestre = $_POST['cuatrimestre'];
    $correo = $_POST['correo'];
    $estado = $_POST['estado'];

    // Verificar duplicados
    $sql = "SELECT COUNT(*) AS count FROM alumnos WHERE (matricula = ? OR nombre = ? OR correo = ?) AND id != ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $matricula, $nombre, $correo, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        echo "Error: Ya existe un alumno con la misma matrícula, nombre o correo.";
    } else {
        // Preparar la consulta SQL
        $sql = "UPDATE alumnos SET matricula=?, nombre=?, cuatrimestre=?, correo=?, estado=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssissi", $matricula, $nombre, $cuatrimestre, $correo, $estado, $id);

        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            echo "Datos actualizados correctamente";
        } else {
            echo "Error al actualizar los datos: " . $stmt->error;
        }
    }

    // Cerrar la declaración preparada
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>
