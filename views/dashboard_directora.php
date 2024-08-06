<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'directora') {
    header('Location: index.html');
    exit;
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Usuario';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menu Directora</title>
    <link rel="stylesheet" href="../css/directora.css">
    <link rel="icon" href="../assets/img/logo-utc-v01.svg">
</head>
<body class="directora">
<div class="menu-bar">
    <a href="../actions/logout.php" class="logout-button">Cerrar sesión</a>
</div>

<div class="welcome-container">
    <h1>Bienvenida, <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></h1>
    <h2>Tu rol es: Directora</h2>
    <p>Acceso a funciones de directora</p>
    <div class="button-container">
        <a href="../directora/crudalumnos/alumnos.php?user=<?php echo urlencode($username); ?>&rol=directora" class="button">
            <img src="../assets/img/estudiantes.png" alt="Función 1">
            Administrar Alumnos
        </a>
        <a href="../directora/crudadmnistrativos/usuarios.php?user=<?php echo urlencode($username); ?>&rol=directora" class="button">
            <img src="../assets/img/gerente.png" alt="Función 2">
            Administrar usuarios
        </a>
    </div>
</div>
<footer class="footer">
    © 2024 Nombre de la Institución
</footer>
</body>
</html>
