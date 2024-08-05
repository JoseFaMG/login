
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuarios</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
    <div class="navbar">
        <span>Bienvenid@, <?php echo $_SESSION['user']; ?></span>
        <button onclick="location.href='add.html'">Agregar Usuario</button>
        <button onclick="location.href='../../views/dashboard.php'">Menú Principal</button>
    </div>

    <h1>Gestión de Administrativos</h1>

    <div class="controls">
        <input type="text" id="searchInput" placeholder="Buscar...">
        <button class="search-button" id="searchButton">Buscar</button>
    </div>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Fecha de Registro</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="usuariosData">

        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch('php/list.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('usuariosData');
                data.forEach(usuario => {
                    const row = document.createElement('tr');

                    row.innerHTML = `
            <td>${usuario.id}</td>
            <td>${usuario.username}</td>
            <td>${usuario.nombre}</td>
            <td>${usuario.apellido}</td>
            <td>${usuario.email}</td>
            <td>${usuario.fecha_registro}</td>
            <td>
              <button class="edit-button" onclick="editItem(${usuario.id})"><i class="fas fa-edit">Edit</button>
              <button class="delete-button" onclick="deleteItem(${usuario.id})"><i class="fas fa-trash-alt">Del</button>
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
        if (confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
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
</script>
</body>
</html>
