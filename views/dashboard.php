<?php
// dashboard.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit;
}

$rol = $_SESSION['rol'];
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Usuario';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" href="../css/common.css">
    <?php
    // Cargar el CSS correspondiente basado en el rol del usuario
    if ($rol === 'coordinadora') {
        echo '<link rel="stylesheet" href="../css/coordinadora.css">';
    } elseif ($rol === 'directora') {
        echo '<link rel="stylesheet" href="../css/directora.css">';
    } elseif ($rol === 'cobranza') {
        echo '<link rel="stylesheet" href="../css/cobranza.css">';
    }
    ?>
    <link rel="icon" href="../assets/img/logo-utc-v01.svg">
</head>
<body class="<?php echo htmlspecialchars($rol); ?>">
<div class="menu-bar">
    <a href="../actions/logout.php" class="button">Cerrar sesión</a>
</div>

<div class="welcome-container">
    <h1>Bienvenida, <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></h1>
    <h2>Tu rol es: <?php echo htmlspecialchars($rol, ENT_QUOTES, 'UTF-8'); ?></h2>

    <?php if ($rol === 'coordinadora'): ?>
        <p>Acceso a funciones de coordinadora</p>
        <div class="button-container">
            <a href="../coordinadoras/crudalumnos/alumnos.php?user=<?php echo urlencode($username); ?>&rol=<?php echo urlencode($rol); ?>" class="button">
                <img src="../assets/img/estudiantes.png" alt="Función 1">
                Administrar Alumnos
            </a>
            <a href="../coordinadoras/crudadmnistrativos/usuarios.php?user=<?php echo urlencode($username); ?>&rol=<?php echo urlencode($rol); ?>" class="button">
                <img src="../assets/img/gerente.png" alt="Función 2">
                Administrar usuarios
            </a>
        </div>
    <?php elseif ($rol === 'directora'): ?>
        <p>Acceso a funciones de directora</p>
        <div class="button-container">
            <a href="../directora/crudalumnos/alumnos.php?user=<?php echo urlencode($username); ?>&rol=<?php echo urlencode($rol); ?>" class="button">
                <img src="../assets/img/estudiantes.png" alt="Función 1">
                Administrar Alumnos
            </a>
            <a href="../directora/crudadmnistrativos/usuarios.php?user=<?php echo urlencode($username); ?>&rol=<?php echo urlencode($rol); ?>" class="button">
                <img src="../assets/img/gerente.png" alt="Función 2">
                Administrar usuarios
            </a>
        </div>
    <?php elseif ($rol === 'cobranza'): ?>
        <p>Acceso a funciones de cobranza</p>
        <div class="button-container">
            <a href="../cobranza/crudalumnos/alumnos.php?user=<?php echo urlencode($username); ?>&rol=<?php echo urlencode($rol); ?>" class="button">
                <img src="../assets/img/estudiantes.png" alt="Función 1">
                Administrar Alumnos
            </a>
            <a href="../cobranza/crudadmnistrativos/usuarios.php?user=<?php echo urlencode($username); ?>&rol=<?php echo urlencode($rol); ?>" class="button">
                <img src="../assets/img/gerente.png" alt="Función 2">
                Administrar usuarios
            </a>
        </div>
    <?php endif; ?>
</div>
<footer class="footer">
    © 2024 Nombre de la Institución
</footer>
</body>
</html>
