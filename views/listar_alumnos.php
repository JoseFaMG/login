<?php
$servername = "localhost";
$username = "root";
$password = "2017452071";
$dbname = "controldeacceso";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Ejecutar la consulta
$sql = "SELECT * FROM alumnos";
$result = $conn->query($sql);

// Comprobar si se recuperaron resultados
if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alumnos</title>
    <link rel="stylesheet" href="../css/list.css">
</head>
<body>
<div class="container">
    <h1>Lista de Alumnos</h1>
    <label for="searchInput"></label><input type="text" id="searchInput" placeholder="Buscar alumno...">
    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Matrícula</th>
            <th>Nombre</th>
            <th>Cuatrimestre</th>
            <th>Correo</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['matricula']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['cuatrimestre']; ?></td>
                    <td><?php echo $row['correo']; ?></td>
                    <td><?php echo $row['estado']; ?></td>
                    <td>
                        <a href="editar_alumno.php?id=<?php echo $row['id']; ?>" class="btn">Editar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No se encontraron alumnos</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const matricula = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            row.style.display = matricula.includes(searchValue) ? '' : 'none';
        });
    });
</script>
</body>
</html>
