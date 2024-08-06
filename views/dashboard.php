<?php
// dashboard.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit;
}

$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" href="../css/style.css" class="rel">
    <link rel="icon" href="../assets/img/logo-utc-v01.svg">
</head>
<body class="<?php echo htmlspecialchars($rol); ?>">
<div class="menu-bar">
    <a href="../actions/logout.php" class="button">Cerrar sesión</a>
</div>

<div class="welcome-container">
    <h1>Bienvenida, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <h2>Tu rol es: <?php echo htmlspecialchars($rol); ?></h2>

    <?php if ($rol === 'coordinadora'): ?>
        <p>Acceso a funciones de coordinadora</p>
        <div class="button-container">
            <a href="../coordinadoras/crudalumnos/alumnos.php" class="button">
                <img src="../assets/img/estudiantes.png" alt="Función 1">
                Administrar Alumnos
            </a>
            <a href="../coordinadoras/crudadmnistrativos/usuarios.php" class="button">
                <img src="../assets/img/gerente.png" alt="Función 2">
                Administrar usuarios
            </a>
        </div>
    <?php elseif ($rol === 'directora'): ?>
        <p>Acceso a funciones de directora</p>
        <div class="button-container">
            <a href="../directora/crudalumnos/alumnos.php" class="button">
                <img src="../assets/img/estudiantes.png" alt="Función 1">
                Administrar Alumnos
            </a>
            <a href="../directora/crudalumnos/alumnos.php" class="button">
                <img src="../assets/img/gerente.png" alt="Función 2">
                Administrar usuarios
            </a>
        </div>
    <?php elseif ($rol === 'cobranza'): ?>
        <p>Acceso a funciones de cobranza</p>
        <div class="button-container">
            <a href="../cobranza/crudalumnos/alumnos.php" class="button">
                <img src="../assets/img/estudiantes.png" alt="Función 1">
                Administrar Alumnos
            </a>
            <a href="../cobranza/crudalumnos/alumnos.php" class="button">
                <img src="../assets/img/gerente.png" alt="Función 2">
                Administrar usuarios
            </a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
