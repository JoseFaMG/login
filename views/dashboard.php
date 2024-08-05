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
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <?php if ($rol === 'coordinadora'): ?>
        <link rel="stylesheet" href="../css/coordinadora.css">
    <?php elseif ($rol === 'cobranza'): ?>
        <link rel="stylesheet" href="../css/cobranza.css">
    <?php elseif ($rol === 'directora'): ?>
        <link rel="stylesheet" href="../css/directora.css">
    <?php endif; ?>
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
        <ul>
            <li><a href="../coordinadoras/crudalumnos/alumnos.php" class="button">
                    <img src="../assets/img/estudiantes.png" alt="Función 1">
                    Administrar Alumnos
                </a></li>
            <li><a href="../coordinadoras/crudadmnistrativos/usuarios.php" class="button">
                    <img src="../assets/img/gerente.png" alt="Función 2">
                    Administrar usuarios
                </a></li>
        </ul>
    <?php elseif ($rol === 'cobranza'): ?>
        <p>Acceso a funciones de cobranza</p>
        <ul>
            <li><a href="../cobranza/crudalumnos/alumnos.php" class="button">
                    <img src="../assets/img/estudiantes.png" alt="Función 1">
                    Administrar Alumnos
                </a></li>
            <li><a href="../cobranza/crudalumnos/alumnos.php" class="button">
                    <img src="../assets/img/gerente.png" alt="Función 2">
                    Administrar usuarios
                </a></li>
        </ul>
    <?php elseif ($rol === 'directora'): ?>
        <p>Acceso a funciones de directora</p>
        <ul>
            <li><a href="../directora/crudalumnos/alumnos.php" class="button">
                    <img src="../assets/img/estudiantes.png" alt="Función 1">
                    Administrar Alumnos
                </a></li>
            <li><a href="../directora/crudalumnos/alumnos.php" class="button">
                    <img src="../assets/img/gerente.png" alt="Función 2">
                    Administrar usuarios
                </a></li>
        </ul>
    <?php endif; ?>
</div>
</body>
</html>
