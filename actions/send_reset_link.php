<?php
// send_reset_link.php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $stmt = $conn->prepare('SELECT * FROM usuarios WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $token = bin2hex(random_bytes(50));
        $stmt = $conn->prepare('UPDATE usuarios SET reset_token = ?, reset_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?');
        $stmt->bind_param('ss', $token, $email);
        $stmt->execute();

        $reset_link = "http://yourdomain.com/views/reset_password.php?token=" . $token;
        $subject = "Restaurar Contraseña";
        $message = "Haz clic en el siguiente enlace para restaurar tu contraseña: " . $reset_link;
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "Enlace de restauración enviado a tu correo electrónico.";
        } else {
            echo "Error al enviar el correo electrónico.";
        }
    } else {
        echo "Correo electrónico no encontrado.";
    }
}
?>
