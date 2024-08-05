<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="login-container">
    <form action="../actions/update_password.php" method="POST">
        <h2>Restablecer Contraseña</h2>
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">

        <label for="password">Nueva Contraseña</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirmar Contraseña</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit">Restablecer Contraseña</button>
    </form>
</div>
</body>
</html>
