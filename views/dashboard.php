<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit;
}

$rol = $_SESSION['rol'];

switch ($rol) {
    case 'directora':
        header('Location: dashboard_directora.php');
        break;
    case 'coordinadora':
        header('Location: dashboard_coordinadora.php');
        break;
    case 'cobranza':
        header('Location: dashboard_cobranza.php');
        break;
    case 'p':
        break;

    default:
        header('Location: index.html');
        break;
}
exit;

