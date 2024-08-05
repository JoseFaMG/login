<?php
// update_password.php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $stmt = $conn->prepare('SELECT * FROM usuarios WHERE reset_token = ? AND reset_expiry > NOW()');
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare('UPDATE usuarios SET password_hash = ?, reset_token = NULL, reset_expiry = NULL WHERE id = ?');
            $stmt->bind_param('si', $password_hash, $user['id']);
            $stmt->execute();

            echo "Contraseña restablecida correctamente. <a href='../views/index.html'>Iniciar sesión</a>";
        } else {
            echo "Enlace de restauración inválido o caducado.";
        }
    } else {
        echo "Las contraseñas no coinciden.";
    }
}
?>
