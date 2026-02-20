<?php
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Hash de Contraseña</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .container { max-width: 400px; margin: 50px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button { width: 100%; background: #3498db; color: #fff; padding: 12px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        button:hover { background: #2980b9; }
        .hash { background: #e8f4f8; padding: 10px; border-radius: 5px; margin-top: 15px; word-break: break-all; }
    </style>
</head>
<body>
    <div class="container">
        <h2>🔑 Generar Hash de Contraseña</h2>
        <form method="POST">
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="password" required style="padding-right:40px;">
                    <span id="togglePassword" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer; font-size:18px; color:#888;">👁️</span>
                </div>
            </div>
            <button type="submit">Generar Hash</button>
        </form>
        <?php if (isset($hash)): ?>
            <div class="hash">
                <strong>Hash generado:</strong><br>
                <?php echo htmlspecialchars($hash); ?>
            </div>
        <?php endif; ?>
    </div>
    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });
    </script>
</body>
</html> 