<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restaurar Contraseña</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="login-container">
    <form action="../actions/send_reset_link.php" method="POST">
        <h2>Restaurar Contraseña</h2>
        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" name="email" required>

        <button type="submit">Enviar Enlace de Restauración</button>
        <a href="index.html">Volver al Login</a>
    </form>
</div>
</body>
</html>
