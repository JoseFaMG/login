<?php
$servername = "localhost";
$username = "root";
$password = "2017452071";
$dbname = "controldeacceso";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $alumnoId = $_GET['id'];
    $sql = "SELECT * FROM controldeacceso.alumnos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $alumnoId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $alumno = $result->fetch_assoc();
    } else {
        echo "Alumno no encontrado.";
        exit;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $alumnoId = $_POST['id'];
    $nombre = $_POST['nombre'];
    $cuatrimestre = $_POST['cuatrimestre'];
    $correo = $_POST['correo'];
    $estado = $_POST['estado'];

    $sql = "UPDATE controldeacceso.alumnos SET nombre = ?, cuatrimestre = ?, correo = ?, estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissi", $nombre, $cuatrimestre, $correo, $estado, $alumnoId);

    if ($stmt->execute()) {
        echo "Datos del alumno actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos del alumno.";
    }
    $stmt->close();
    header("Location: editar_alumno.php?id=" . $alumnoId);
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Alumno</title>
    <link rel="stylesheet" href="../css/crud.css">
</head>
<body>
<div class="menu">
    <button onclick="location.href='../views/listar_alumnos.php'">Control de Acceso</button>
</div>
<div class="container">
    <h1>Editar Alumno</h1>
    <?php if (isset($alumno)): ?>
        <form action="editar_alumno.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $alumno['id']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $alumno['nombre']; ?>" required>
            <br>
            <label for="cuatrimestre">Cuatrimestre:</label>
            <input type="number" id="cuatrimestre" name="cuatrimestre" value="<?php echo $alumno['cuatrimestre']; ?>" required>
            <br>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $alumno['correo']; ?>" required>
            <br>
            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" value="<?php echo $alumno['estado']; ?>" required>
            <br>
            <button type="submit">Guardar Cambios</button>
        </form>
    <?php else: ?>
        <p>Alumno no encontrado.</p>
    <?php endif; ?>
</div>
</body>
</html>
