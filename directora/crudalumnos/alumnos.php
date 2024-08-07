<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit;
}

if (isset($_GET['status']) && isset($_GET['message'])) {
    $status = $_GET['status'];
    $message = $_GET['message'];

    echo "<div class='message $status'>$message</div>";
}

// Obtener el nombre de usuario y el rol desde la URL si están presentes o desde la sesión
$user = isset($_GET['user']) ? $_GET['user'] : (isset($_SESSION['user']) ? $_SESSION['user'] : 'Usuario');
$rol = isset($_GET['rol']) ? $_GET['rol'] : (isset($_SESSION['rol']) ? $_SESSION['rol'] : 'Rol no definido');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Alumnos</title>
    <link rel="icon" href="../../assets/img/logo-utc-v01.svg">
    <link rel="stylesheet" href="css/stylesalumnos.css">
</head>
<body>

<div class="container">
    <div class="navbar">
        <span>Bienvenid@, <?php echo htmlspecialchars($user, ENT_QUOTES, 'UTF-8'); ?></span>
        <button onclick="location.href='../../views/dashboard.php'">Menú Principal</button>
        <button onclick="location.href='../../actions/logout.php'">Cerrar Sesión</button>
    </div>

    <h1>Gestión de Alumnos - Subir Archivo Excel</h1>

    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="file">Selecciona un archivo Excel:</label>
        <input type="file" name="file" id="file" accept=".xls,.xlsx" required>
        <button type="submit">Subir y Cargar Alumnos</button>
    </form>

    <h2>Alumnos Cargados</h2>

    <div class="controls">
        <label for="searchInput"></label><input type="text" id="searchInput" placeholder="Buscar alumno...">
    </div>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Matrícula</th>
            <th>Nombre</th>
            <th>Cuatrimestre</th>
            <th>Correo Institucional</th>
            <th>Permiso</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="alumnosData">

        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch('php/list.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('alumnosData');
                data.forEach(alumno => {
                    const row = document.createElement('tr');

                    row.innerHTML = `
            <td>${alumno.id}</td>
            <td>${alumno.matricula}</td>
            <td>${alumno.nombre}</td>
            <td>${alumno.cuatrimestre}</td>
            <td>${alumno.correo}</td>
            <td>${alumno.estado}</td>
            <td>
              <button class="edit-button" onclick="editItem(${alumno.id})">Edit</button>
              <button class="delete-button" onclick="deleteItem(${alumno.id})">Del</button>
            </td>
          `;

                    tableBody.appendChild(row);
                });
            });
    });

    function editItem(id) {
        location.href = `edit.html?id=${id}`;
    }

    function deleteItem(id) {
        if (confirm("¿Estás seguro de que quieres eliminar este alumno?")) {
            fetch('php/delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}`
            })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload();
                });
        }
    }
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
