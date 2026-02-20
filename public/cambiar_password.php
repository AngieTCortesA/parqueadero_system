<?php
require_once 'config.php';
session_start();

// Redirigir a login si no está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$mensaje = '';
$tipo_mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password_actual = $_POST['password_actual'] ?? '';
    $nueva_password = $_POST['nueva_password'] ?? '';
    $confirmar_password = $_POST['confirmar_password'] ?? '';

    if (empty($password_actual) || empty($nueva_password) || empty($confirmar_password)) {
        $mensaje = 'Todos los campos son obligatorios.';
        $tipo_mensaje = 'error';
    } elseif ($nueva_password !== $confirmar_password) {
        $mensaje = 'La nueva contraseña y la confirmación no coinciden.';
        $tipo_mensaje = 'error';
    } else {
        $pdo = conectarDB();
        $stmt = $pdo->prepare('SELECT password FROM usuarios WHERE id = ?');
        $stmt->execute([$_SESSION['usuario_id']]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$usuario || !password_verify($password_actual, $usuario['password'])) {
            $mensaje = 'La contraseña actual es incorrecta.';
            $tipo_mensaje = 'error';
        } else {
            $hash = password_hash($nueva_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('UPDATE usuarios SET password = ? WHERE id = ?');
            if ($stmt->execute([$hash, $_SESSION['usuario_id']])) {
                $mensaje = 'Contraseña actualizada correctamente.';
                $tipo_mensaje = 'success';
            } else {
                $mensaje = 'Error al actualizar la contraseña.';
                $tipo_mensaje = 'error';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .container { max-width: 400px; margin: 50px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="password"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button { width: 100%; background: #3498db; color: #fff; padding: 12px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        button:hover { background: #2980b9; }
        .mensaje { padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; }
        .mensaje.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .mensaje.error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .volver { display: block; text-align: center; margin-top: 15px; color: #3498db; text-decoration: none; }
        .volver:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h2>🔒 Cambiar Contraseña</h2>
        <?php if ($mensaje): ?>
            <div class="mensaje <?php echo $tipo_mensaje; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="password_actual">Contraseña Actual:</label>
                <input type="password" name="password_actual" id="password_actual" required>
            </div>
            <div class="form-group">
                <label for="nueva_password">Nueva Contraseña:</label>
                <input type="password" name="nueva_password" id="nueva_password" required>
            </div>
            <div class="form-group">
                <label for="confirmar_password">Confirmar Nueva Contraseña:</label>
                <input type="password" name="confirmar_password" id="confirmar_password" required>
            </div>
            <button type="submit">Actualizar Contraseña</button>
        </form>
        <?php require __DIR__ . '/../resources/partials/footer.php'; ?>
    </div>
</body>
</html> 